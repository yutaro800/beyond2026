<?php
/**
 * BEYOND 固定ページ共通（サブページ用）
 *
 * slug に応じて template-parts/content-{slug}.php を表示する。
 * 例: /beyond-2026/race-info/ → content-race-info.php
 */

defined( 'ABSPATH' ) || exit;

get_header();

$slug = get_post_field( 'post_name', get_queried_object_id() );
$part = locate_template( "template-parts/content-{$slug}.php" );

if ( $part ) {
	load_template( $part, false );
} else {
	?>
<section class="news section section--white">
  <div class="fade-in">
    <p>ページが見つかりませんでした。</p>
    <p class="news__more"><a href="<?php echo esc_url( beyond_home_url() ); ?>">トップへ戻る</a></p>
  </div>
</section>
	<?php
}

get_footer();
