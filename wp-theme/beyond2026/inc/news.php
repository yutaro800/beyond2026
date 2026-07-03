<?php
/**
 * NEWS 表示ヘルパー
 */

defined( 'ABSPATH' ) || exit;

/**
 * BEYOND 用ニュース投稿のクエリ引数
 *
 * @param int $count 取得件数。
 * @return array<string, mixed>
 */
function beyond_news_query_args( int $count ): array {
	$args = array(
		'post_type'           => 'post',
		'posts_per_page'      => $count,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	);

	$category = beyond_news_category_slug();
	if ( $category ) {
		$args['category_name'] = $category;
	}

	return $args;
}

/**
 * ニュース用カテゴリ slug（未設定なら全投稿）
 */
function beyond_news_category_slug(): string {
	$slug = get_option( 'beyond_news_category', 'beyond' );
	return is_string( $slug ) ? sanitize_title( $slug ) : '';
}

/**
 * NEWS 一覧ページ URL
 */
function beyond_news_archive_url(): string {
	$page_id = (int) get_option( 'beyond_news_page_id', 0 );
	if ( $page_id > 0 ) {
		$url = get_permalink( $page_id );
		if ( $url ) {
			return $url;
		}
	}

	$base = beyond_base_slug();
	$page = get_page_by_path( $base ? $base . '/news' : 'news' );
	if ( ! $page && $base ) {
		$page = get_page_by_path( 'news' );
	}
	if ( $page ) {
		return get_permalink( $page );
	}

	return trailingslashit( beyond_home_url() ) . 'news/';
}

/**
 * 日付表示（Y/m/d）
 */
function beyond_news_date( ?int $post_id = null ): string {
	$post_id = $post_id ?: get_the_ID();
	return get_the_date( 'Y/m/d', $post_id );
}

/**
 * ニュース1件の HTML
 */
function beyond_render_news_item( ?WP_Post $post = null ): void {
	if ( ! $post ) {
		global $post;
	}
	?>
	<li class="news__item">
		<span class="news__date"><?php echo esc_html( beyond_news_date( $post->ID ) ); ?></span>
		<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="news__headline">
			<?php echo esc_html( get_the_title( $post ) ); ?>
		</a>
	</li>
	<?php
}

/**
 * ニュース一覧ループ
 *
 * @param WP_Query $query クエリ。
 */
function beyond_render_news_list( WP_Query $query ): void {
	if ( ! $query->have_posts() ) {
		return;
	}

	echo '<ul class="news__list">';
	while ( $query->have_posts() ) {
		$query->the_post();
		beyond_render_news_item();
	}
	echo '</ul>';

	wp_reset_postdata();
}

/**
 * news.html の .pagination に合わせたページネーション
 *
 * @param WP_Query|null $query 対象クエリ（未指定時はメインクエリ）。
 */
function beyond_render_pagination( ?WP_Query $query = null ): void {
	$query   = $query ?? $GLOBALS['wp_query'];
	$total   = (int) $query->max_num_pages;
	$current = max(
		1,
		(int) ( get_query_var( 'paged' ) ?: get_query_var( 'page' ) )
	);

	if ( $total <= 1 ) {
		echo '<nav class="pagination" aria-label="ページネーション">';
		echo '<span class="pagination__item is-current">1</span>';
		echo '</nav>';
		return;
	}

	$links = paginate_links(
		array(
			'total'     => $total,
			'current'   => $current,
			'type'      => 'array',
			'prev_next' => false,
			'end_size'  => 1,
			'mid_size'  => 1,
		)
	);

	if ( ! is_array( $links ) ) {
		return;
	}

	echo '<nav class="pagination" aria-label="ページネーション">';
	foreach ( $links as $link ) {
		if ( str_contains( $link, 'current' ) ) {
			if ( preg_match( '/>(\d+)</', $link, $m ) ) {
				echo '<span class="pagination__item is-current">' . esc_html( $m[1] ) . '</span>';
			}
			continue;
		}
		if ( preg_match( '/href="([^"]+)">(\d+)</', $link, $m ) ) {
			printf(
				'<a href="%s" class="pagination__item">%s</a>',
				esc_url( $m[1] ),
				esc_html( $m[2] )
			);
		}
	}
	echo '</nav>';
}
