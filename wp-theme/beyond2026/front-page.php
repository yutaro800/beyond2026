<?php
/**
 * トップページ（Local スタンドアロン用）
 *
 * 本番（同一 WP）では page-templates/beyond-top.php を /beyond/ 固定ページに指定。
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part( 'template-parts/front-page', 'content' );
get_footer();
