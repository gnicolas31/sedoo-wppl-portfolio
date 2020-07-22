<?php

/**
 * Plugin Name: Sedoo - Portfolio
 * Description: Affiche un bloc portfolio
 * Version: 0.4.3
 * Author: Nicolas Gruwe  - SEDOO DATA CENTER
 * Author URI:      https://www.sedoo.fr 
 * GitHub Plugin URI: sedoo/sedoo-wppl-portfolio
 * GitHub Branch:     master
 */

if ( ! function_exists('get_field') ) {
        
	add_action( 'admin_init', 'sb_plugin_deactivate');
	add_action( 'admin_notices', 'sb_plugin_admin_notice');

	//Désactiver le plugin
	function sb_plugin_deactivate () {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
	
	// Alerter pour expliquer pourquoi il ne s'est pas activé
	function sb_plugin_admin_notice () {
		
		echo '<div class="error">Le plugin requiert ACF Pro pour fonctionner <br><strong>Activez ACF Pro ci-dessous</strong> ou <a href=https://wordpress.org/plugins/advanced-custom-fields/> Téléchargez ACF Pro &raquo;</a><br></div>';

		if ( isset( $_GET['activate'] ) ) 
			unset( $_GET['activate'] );	
	}
} else {

  function sedoo_portfolio_enqueu_script() {
      // le fichier js qui contient les fonctions tirgger au change des select
      $src_ctp = plugins_url().'/sedoo-wppl-portfolio/js/back.js';
      wp_enqueue_script('sedoo_portfolio', $src_ctp,  array ( 'jquery' ));                 
      wp_localize_script( 'sedoo_portfolio', 'ajaxurl', admin_url( 'admin-ajax.php' ) );      
  }
  add_action( 'admin_head', 'sedoo_portfolio_enqueu_script' );

  function sedoo_portfolio_front_js() {
      // le fichier js qui contient les fonctions tirgger au change des select
      $scrpt_portfoliocpt =  plugin_dir_url( __FILE__ ).'/js/front.js';
      wp_enqueue_script('sedoo_portfolio_front', $scrpt_portfoliocpt,  array ( 'jquery' ));   
    }
    add_action( 'wp_head', 'sedoo_portfolio_front_js' );
    
    

  include 'sedoo-wppl-portfoliocpt-functions.php';
  include 'sedoo-wppl-portfoliocpt-acf.php';
  include 'inc/sedoo-wppl-portfolio-acf-fields.php';

}