<?php
/**
 * 共通フッター
 */

defined( 'ABSPATH' ) || exit;
?>
<footer class="footer">
  <p class="footer__line">
    <a href="<?php echo esc_url( beyond_home_url() ); ?>" class="footer__link">BEYOND</a><span class="footer__sep" aria-hidden="true">/</span><a href="https://beyond2025rslab.com/top/" class="footer__link" target="_blank" rel="noopener">2025</a><span class="footer__sep" aria-hidden="true">/</span><a href="https://rslab.tokyo/beyond/" class="footer__link">2023</a>
  </p>
  <p class="footer__line footer__line--sub">
    <a href="https://rslab.tokyo/beyond-contact" class="footer__link" target="_blank" rel="noopener">CONTACT</a><span class="footer__sep" aria-hidden="true">/</span><a href="https://rslab.tokyo" class="footer__link" target="_blank" rel="noopener">RUNNING SCIENCE LAB</a>
  </p>
  <p class="footer__copyright">©RUNNING SCIENCE LAB</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
