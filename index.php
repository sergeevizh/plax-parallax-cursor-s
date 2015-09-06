<?php
/*
Plugin Name: Plax jQuery powered parallaxing for WordPress by Systemo
Plugin URI: https://github.com/systemo-biz/plax-parallax-cursor-s
Description: Create parallax for site by shortcode: [plax-s][plaxify][plaxify x=20 y=33 invert=true selector=".btn"][/plax-s]
Author: Systemo
Author URI: http://systemo.biz
Version: 0.1
*/


//Load script
function load_ss_plax_s(){

  wp_register_script( 'plax', plugins_url( '/inc/plax/js/plax.js',__FILE__ ), array('jquery'), '1');
  wp_enqueue_script('plax');

} add_action('wp_enqueue_scripts', 'load_ss_plax_s');


//Shortcode wrapper
add_shortcode( 'plax-s', function($atts, $content){
  extract( shortcode_atts( array(
    'selector' => "body",
  ), $atts ));

  $parametrs = '';
  if($activityTarget) $parametrs = '{ "activityTarget": $("'. $selector .'")}';


  ob_start();
  ?>
  <script type="text/javascript">

    (function ($) {
      <?php echo do_shortcode( $content ); ?>

      $.plax.enable(<?php echo $parametrs ?>);
    }(jQuery));
  </script>

  <?php
  $html = ob_get_contents();
  ob_get_clean();

  return $html;

});


//Shortcode for parametr
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
