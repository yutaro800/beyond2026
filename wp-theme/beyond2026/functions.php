<?php
/**
 * BEYOND 2026 テーマ
 */

defined( 'ABSPATH' ) || exit;

define( 'BEYOND2026_VERSION', '1.0.0' );
define( 'BEYOND_ENTRY_URL', 'https://moshicom.com/148834' );
define( 'BEYOND_NEWS_LATEST_COUNT', 4 );
define( 'BEYOND_NEWS_PER_PAGE', 10 );

require_once get_template_directory() . '/inc/news.php';

/**
 * テーマセットアップ
 */
function beyond2026_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'beyond2026_setup' );

/**
 * CSS / JS 読み込み
 */
function beyond2026_enqueue_assets(): void {
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style(
		'beyond2026-google-fonts',
		'https://fonts.googleapis.com/css2?family=Anton&family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'beyond2026-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
		array(),
		'6.5.1'
	);
	wp_enqueue_style(
		'beyond2026-main',
		$theme_uri . '/assets/style.css',
		array(),
		BEYOND2026_VERSION
	);
	wp_enqueue_script(
		'beyond2026-main',
		$theme_uri . '/assets/script.js',
		array(),
		BEYOND2026_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'beyond2026_enqueue_assets' );

/**
 * NEWS 一覧の1ページ件数
 *
 * @param WP_Query $query クエリ。
 */
function beyond2026_news_posts_per_page( WP_Query $query ): void {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( $query->is_home() || $query->is_category( beyond_news_category_slug() ) ) {
		$query->set( 'posts_per_page', BEYOND_NEWS_PER_PAGE );

		$category = beyond_news_category_slug();
		if ( $category && $query->is_home() ) {
			$query->set( 'category_name', $category );
		}
	}
}
add_action( 'pre_get_posts', 'beyond2026_news_posts_per_page' );

/**
 * テーマ画像 URL
 */
function beyond_asset_url( string $path = '' ): string {
	return trailingslashit( get_template_directory_uri() . '/assets/images' ) . ltrim( $path, '/' );
}

/**
 * インライン background-image 用
 */
function beyond_bg_style( string $file ): string {
	return sprintf(
		"background-image: url('%s');",
		esc_url( beyond_asset_url( $file ) )
	);
}

/**
 * サブページ URL（静的 HTML から WP 固定ページへ移行するまでの暫定）
 */
function beyond_page_url( string $slug ): string {
	return home_url( '/' . ltrim( $slug, '/' ) . '/' );
}

/**
 * 管理画面: 簡易設定
 */
function beyond2026_register_settings(): void {
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
		'beyond_news_category',
		'BEYOND NEWS カテゴリ slug',
		static function (): void {
			$value = get_option( 'beyond_news_category', 'beyond' );
			printf(
				'<input type="text" name="beyond_news_category" value="%s" class="regular-text" />',
				esc_attr( $value )
			);
			echo '<p class="description">rslab.tokyo 上で BEYOND 用に使う投稿カテゴリの slug（例: beyond）</p>';
		},
		'general'
	);

	add_settings_field(
		'beyond_news_page_id',
		'BEYOND NEWS 一覧ページ ID',
		static function (): void {
			$value = (int) get_option( 'beyond_news_page_id', 0 );
			printf(
				'<input type="number" name="beyond_news_page_id" value="%d" class="small-text" min="0" />',
				$value
			);
			echo '<p class="description">「NEWS 一覧」固定ページの ID。未設定時は slug <code>news</code> を参照。</p>';
		},
		'general'
	);
}
add_action( 'admin_init', 'beyond2026_register_settings' );
