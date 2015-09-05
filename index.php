<?php
/*
Plugin Name: Parallax.js for WordPress by Systemo
Plugin URI: https://github.com/systemo-biz/plax-parallax-cursor-s
Description: Создает Параллакс эффект от курсора шорткодом типа: [plax-s][plaxify][plaxify x=20 y=33 invert=true selector=".btn"][/plax-s]
Author: Systemo
Author URI: http://systemo.biz
Version: 0.1
*/



function load_ss_plax_s(){

  wp_register_script( 'plax', plugins_url( '/inc/plax/js/plax.js',__FILE__ ), array('jquery'), '1');
  wp_enqueue_script('plax');

} add_action('wp_enqueue_scripts', 'load_ss_plax_s');



add_shortcode( 'plax-s', function($atts, $content){

  ob_start();
  ?>
  <script type="text/javascript">

    (function ($) {
      <?php echo do_shortcode( $content ); ?>

      $.plax.enable();
    }(jQuery));
  </script>

  <?php
  $html = ob_get_contents();
  ob_get_clean();

  return $html;

});

add_shortcode( 'plaxify', function($atts){
  extract( shortcode_atts( array(
    'selector' => "img",
    'x' => 22,
    'y' => 33,
    'invert' => 'false',
  ), $atts ));

  $parametrs = '"xRange": '.$x . ', "yRange": '.$y . ', "invert": ' . $invert;

  return '$("' . $selector . '").plaxify({' . $parametrs . '});';
});
