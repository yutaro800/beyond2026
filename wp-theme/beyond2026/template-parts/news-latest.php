<?php
/**
 * トップ NEWS 欄（最新4件）
 */

defined( 'ABSPATH' ) || exit;

$query = new WP_Query( beyond_news_query_args( BEYOND_NEWS_LATEST_COUNT ) );

if ( $query->have_posts() ) {
	beyond_render_news_list( $query );
} else {
	?>
	<ul class="news__list">
		<li class="news__item news__item--placeholder">
			<span class="news__date">—</span>
			<span class="news__headline">ニュースは準備中です</span>
		</li>
	</ul>
	<?php
}
?>

<a href="<?php echo esc_url( beyond_news_archive_url() ); ?>" class="news__more">ニュース一覧へ</a>
