<?php
/**
 * Plugin Name: BEYOND 2026 Loader
 * Description: rslab.tokyo 本体 WordPress 内で /beyond/ 配下と BEYOND カテゴリ投稿に beyond2026 テーマを適用します。
 * Version: 1.0.1
 * Author: RUNNING SCIENCE LAB
 * Text Domain: beyond2026-loader
 */

defined( 'ABSPATH' ) || exit;

define( 'BEYOND2026_LOADER_VERSION', '1.0.1' );
define( 'BEYOND2026_THEME', 'beyond2026' );

/**
 * BEYOND セクションのベース slug（プラグイン用）
 */
function beyond2026_loader_base_slug(): string {
	$slug = get_option( 'beyond_base_slug', 'beyond' );
	return is_string( $slug ) ? sanitize_title( $slug ) : 'beyond';
}

/**
 * 過去年度アーカイブ（別 WP 等）でテーマ切替を除外するパス
 *
 * @return string[] リクエストパス（先頭・末尾スラッシュなし）のプレフィックス。
 */
function beyond2026_loader_excluded_path_prefixes(): array {
	$base = beyond2026_loader_base_slug();
	if ( ! $base ) {
		return array();
	}

	return array(
		$base . '/2023',
	);
}

/**
 * beyond2026 テーマを適用すべきリクエストか
 */
function beyond2026_loader_should_use_theme(): bool {
	static $result = null;

	if ( null !== $result ) {
		return $result;
	}

	if ( is_admin() && ! wp_doing_ajax() ) {
		return $result = false;
	}

	if ( BEYOND2026_THEME === get_option( 'stylesheet' ) ) {
		return $result = true;
	}

	if ( ! wp_get_theme( BEYOND2026_THEME )->exists() ) {
		return $result = false;
	}

	$base = beyond2026_loader_base_slug();
	$path = trim( (string) parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '/' ), PHP_URL_PATH ), '/' );

	foreach ( beyond2026_loader_excluded_path_prefixes() as $excluded ) {
		if ( $path === $excluded || str_starts_with( $path, $excluded . '/' ) ) {
			return $result = false;
		}
	}

	if ( $base && ( $path === $base || str_starts_with( $path, $base . '/' ) ) ) {
		return $result = true;
	}

	$post_id = url_to_postid( home_url( '/' . $path . '/' ) );
	if ( $post_id ) {
		$post = get_post( $post_id );
		$cat  = get_option( 'beyond_news_category', 'beyond' );
		if ( $post && 'post' === $post->post_type && is_string( $cat ) && has_category( sanitize_title( $cat ), $post ) ) {
			return $result = true;
		}
	}

	return $result = false;
}

/**
 * テーマ切り替え
 *
 * @param string $value 現在のテーマ slug。
 */
function beyond2026_loader_switch_theme( string $value ): string {
	return beyond2026_loader_should_use_theme() ? BEYOND2026_THEME : $value;
}
add_filter( 'stylesheet', 'beyond2026_loader_switch_theme' );
add_filter( 'template', 'beyond2026_loader_switch_theme' );

/**
 * 管理画面: BEYOND 設定
 */
function beyond2026_loader_register_settings(): void {
	register_setting(
		'general',
		'beyond_base_slug',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_title',
			'default'           => 'beyond',
		)
	);
	register_setting(
		'general',
		'beyond_top_page_id',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'absint',
			'default'           => 0,
		)
	);
	register_setting(
		'general',
		'beyond_news_category',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_title',
			'default'           => 'beyond',
		)
	);
	register_setting(
		'general',
		'beyond_news_page_id',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'absint',
			'default'           => 0,
		)
	);

	add_settings_field(
		'beyond_base_slug',
		'BEYOND ベース slug',
		static function (): void {
			printf(
				'<input type="text" name="beyond_base_slug" value="%s" class="regular-text" />',
				esc_attr( beyond2026_loader_base_slug() )
			);
			echo '<p class="description">BEYOND セクションの URL プレフィックス（例: <code>beyond</code> → /beyond/）</p>';
		},
		'general'
	);

	add_settings_field(
		'beyond_top_page_id',
		'BEYOND トップ固定ページ ID',
		static function (): void {
			printf(
				'<input type="number" name="beyond_top_page_id" value="%d" class="small-text" min="0" />',
				(int) get_option( 'beyond_top_page_id', 0 )
			);
			echo '<p class="description">BEYOND トップ（/beyond/）の固定ページ ID。テンプレート「BEYOND トップ」を指定。</p>';
		},
		'general'
	);

	add_settings_field(
		'beyond_news_category',
		'BEYOND NEWS カテゴリ slug',
		static function (): void {
			printf(
				'<input type="text" name="beyond_news_category" value="%s" class="regular-text" />',
				esc_attr( get_option( 'beyond_news_category', 'beyond' ) )
			);
			echo '<p class="description">BEYOND 用ニュース投稿のカテゴリ slug。本体 WP の「投稿」から管理します。</p>';
		},
		'general'
	);

	add_settings_field(
		'beyond_news_page_id',
		'BEYOND NEWS 一覧ページ ID',
		static function (): void {
			printf(
				'<input type="number" name="beyond_news_page_id" value="%d" class="small-text" min="0" />',
				(int) get_option( 'beyond_news_page_id', 0 )
			);
			echo '<p class="description">NEWS 一覧固定ページ ID。テンプレート「BEYOND NEWS 一覧」を指定。</p>';
		},
		'general'
	);
}
add_action( 'admin_init', 'beyond2026_loader_register_settings' );

/**
 * プラグイン有効化時: テーマ存在チェック
 */
function beyond2026_loader_activate(): void {
	if ( ! wp_get_theme( BEYOND2026_THEME )->exists() ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die(
			esc_html__( 'beyond2026 テーマが wp-content/themes/ にインストールされていません。先にテーマをアップロードしてください。', 'beyond2026-loader' ),
			esc_html__( 'BEYOND 2026 Loader', 'beyond2026-loader' ),
			array( 'back_link' => true )
		);
	}
}
register_activation_hook( __FILE__, 'beyond2026_loader_activate' );
