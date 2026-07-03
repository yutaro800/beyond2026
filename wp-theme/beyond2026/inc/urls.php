<?php
/**
 * BEYOND セクション URL ヘルパー（同一 WP・/beyond/ 配下向け）
 */

defined( 'ABSPATH' ) || exit;

/**
 * BEYOND ベース slug
 */
function beyond_base_slug(): string {
	$slug = get_option( 'beyond_base_slug', 'beyond' );
	return is_string( $slug ) ? sanitize_title( $slug ) : 'beyond';
}

/**
 * BEYOND トップ URL
 */
function beyond_home_url(): string {
	$page_id = (int) get_option( 'beyond_top_page_id', 0 );
	if ( $page_id > 0 ) {
		$url = get_permalink( $page_id );
		if ( $url ) {
			return trailingslashit( $url );
		}
	}

	$base = beyond_base_slug();
	if ( $base ) {
		return home_url( '/' . $base . '/' );
	}

	return trailingslashit( home_url( '/' ) );
}

/**
 * BEYOND トップ固定ページか
 */
function beyond_is_top_page(): bool {
	if ( ! is_page() ) {
		return false;
	}

	$top_id = (int) get_option( 'beyond_top_page_id', 0 );
	if ( $top_id > 0 ) {
		return get_queried_object_id() === $top_id;
	}

	return is_page( beyond_base_slug() );
}

/**
 * BEYOND セクション内の固定ページか（トップまたはその子ページ）
 */
function beyond_is_section_page(): bool {
	if ( ! is_page() ) {
		return false;
	}

	if ( beyond_is_top_page() ) {
		return true;
	}

	$top_id = (int) get_option( 'beyond_top_page_id', 0 );
	if ( $top_id <= 0 ) {
		$top = get_page_by_path( beyond_base_slug() );
		$top_id = $top ? (int) $top->ID : 0;
	}

	if ( $top_id <= 0 ) {
		return false;
	}

	$page_id = get_queried_object_id();
	if ( wp_get_post_parent_id( $page_id ) === $top_id ) {
		return true;
	}

	$ancestors = get_post_ancestors( $page_id );
	return in_array( $top_id, $ancestors, true );
}
