<?php
/**
 * NEWS 一覧ページテンプレート
 *
 * Template Name: BEYOND NEWS 一覧
 */

defined( 'ABSPATH' ) || exit;

get_header();

$paged = max( 1, (int) ( get_query_var( 'paged' ) ?: get_query_var( 'page' ) ) );
$query = new WP_Query(
	array_merge(
		beyond_news_query_args( BEYOND_NEWS_PER_PAGE ),
		array( 'paged' => $paged )
	)
);
?>
<section class="news section section--white">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en" aria-hidden="true">NEWS</span>
    <span class="section__title-ja">ニュース</span>
  </h2>
  <?php
	if ( $query->have_posts() ) {
		beyond_render_news_list( $query );
		beyond_render_pagination( $query );
		wp_reset_postdata();
	} else {
		?>
  <ul class="news__list">
    <li class="news__item news__item--placeholder">
      <span class="news__date">—</span>
      <span class="news__headline">ニュースは準備中です</span>
    </li>
  </ul>
  <nav class="pagination" aria-label="ページネーション">
    <span class="pagination__item is-current">1</span>
  </nav>
		<?php
	}
  ?>
  </div>
</section>
<?php
get_footer();
