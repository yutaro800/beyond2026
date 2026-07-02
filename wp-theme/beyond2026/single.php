<?php
/**
 * ニュース記事詳細
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="news section section--white">
  <div class="fade-in">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <p class="news__date"><?php echo esc_html( beyond_news_date() ); ?></p>
      <h1 class="section__title">
        <span class="section__title-en" aria-hidden="true">NEWS</span>
        <span class="section__title-ja"><?php the_title(); ?></span>
      </h1>
      <div class="news-single__body">
        <?php the_content(); ?>
      </div>
      <p class="news__more">
        <a href="<?php echo esc_url( beyond_news_archive_url() ); ?>">← ニュース一覧へ</a>
      </p>
    <?php endwhile; ?>
  <?php endif; ?>
  </div>
</section>
<?php
get_footer();
