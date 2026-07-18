<?php
/**
 * BEYOND 2026 テーマ
 */

defined( 'ABSPATH' ) || exit;

define( 'BEYOND2026_VERSION', '1.0.3' );
define( 'BEYOND_ENTRY_URL', 'https://moshicom.com/148834' );
define( 'BEYOND_NEWS_LATEST_COUNT', 4 );
define( 'BEYOND_NEWS_PER_PAGE', 10 );
define( 'BEYOND_NEWS_YEAR', 2026 );

require_once get_template_directory() . '/inc/urls.php';

$beyond_edition_file = WP_PLUGIN_DIR . '/beyond2026-loader/inc/edition.php';
if ( is_readable( $beyond_edition_file ) ) {
	require_once $beyond_edition_file;
} else {
	require_once get_template_directory() . '/inc/edition.php';
}

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
 * BEYOND 用ファビコン（本体 WP のサイトアイコンより優先）
 */
function beyond2026_favicon_url(): string {
	$file = file_exists( get_template_directory() . '/assets/images/favicon.png' )
		? 'favicon.png'
		: 'favicon.ico';

	return add_query_arg( 'v', BEYOND2026_VERSION, beyond_asset_url( $file ) );
}

function beyond2026_remove_default_site_icon(): void {
	remove_action( 'wp_head', 'wp_site_icon', 99 );
}
add_action( 'wp_head', 'beyond2026_remove_default_site_icon', 0 );

function beyond2026_print_favicon(): void {
	$icon = beyond2026_favicon_url();
	printf(
		'<link rel="icon" type="image/png" href="%s" sizes="32x32">' . "\n",
		esc_url( $icon )
	);
	printf(
		'<link rel="apple-touch-icon" href="%s">' . "\n",
		esc_url( $icon )
	);
}
add_action( 'wp_head', 'beyond2026_print_favicon', 100 );

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
	return trailingslashit( beyond_home_url() ) . ltrim( $slug, '/' ) . '/';
}
