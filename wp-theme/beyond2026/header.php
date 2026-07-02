<?php
/**
 * 共通ヘッダー
 */

defined( 'ABSPATH' ) || exit;

$is_front = is_front_page();
$home     = home_url( '/' );
$news_url = beyond_news_archive_url();
$shop_url = $is_front ? '#shop' : $home . '#shop';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo esc_url( beyond_asset_url( 'favicon.ico' ) ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">
  <a href="<?php echo esc_url( $home ); ?>" class="header__logo">
    <img src="<?php echo esc_url( beyond_asset_url( 'beyond-logo.png' ) ); ?>" alt="BEYOND">
  </a>
  <nav class="header__nav">
    <a href="<?php echo esc_url( BEYOND_ENTRY_URL ); ?>" target="_blank" rel="noopener">ENTRY</a>
    <a href="<?php echo esc_url( $news_url ); ?>">NEWS</a>
    <a href="<?php echo esc_url( $shop_url ); ?>">SHOP</a>
    <a href="https://www.instagram.com/beyond_marathon/" class="header__icon" aria-label="Instagram" target="_blank" rel="noopener">
      <i class="fa-brands fa-instagram"></i>
    </a>
  </nav>
</header>
