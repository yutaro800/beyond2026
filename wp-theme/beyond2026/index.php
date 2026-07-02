<?php
/**
 * index.php — フォールバック
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="news section section--white">
  <div class="fade-in">
    <p>ページが見つかりませんでした。</p>
    <p class="news__more"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップへ戻る</a></p>
  </div>
</section>
<?php
get_footer();
