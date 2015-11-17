  </main>

  <footer class="footer" role="contentinfo">
    <p>Taco Footer</p>
  </footer>
</div><!--/.page-wrap -->
<?php wp_footer(); ?>
<script>
  //$(document).foundation();
</script>
</body>
</html>
<?php
if(class_exists('FlashData')) {
  $flash_data = new FlashData;
  $flash_data->flush();
}