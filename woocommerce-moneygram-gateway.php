<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
Plugin Name: WooCommerce MoneyGram Gateway
Description: Adds MoneyGram Gateway to WooCommerce e-commerce plugin
Version: 1.0
*/

// Include our Gateway Class and register Payment Gateway with WooCommerce
add_action( 'plugins_loaded', 'woo_mg_init', 0 );
function woo_mg_init() {
	// If the parent WC_Payment_Gateway class doesn't exist
	// it means WooCommerce is not installed on the site
	// so do nothing
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
	
	// If we made it this far, then include our Gateway Class
	include_once( 'moneygram.php' );

    /*add_action( 'admin_menu', 'add_submenu', 20 );
    function add_submenu() {
        if ( current_user_can( 'manage_woocommerce' ) ) {
            add_submenu_page( 'woocommerce', __( 'MoneyGram Customer', 'woocommerce' ),  __( 'MoneyGram', 'woocommerce' ) , 'view_woocommerce_reports', 'wc-mm-costomer', array( WC_Gateway_MoneyGram::class, 'mm_costomer_page' ) );
        }
    }*/

	// Now that we have successfully included our class,
	// Lets add it too WooCommerce
	add_filter( 'woocommerce_payment_gateways', 'woo_add_mg_gateway' );
	function woo_add_mg_gateway( $methods ) {
		$methods[] = 'WC_Gateway_MoneyGram';
		return $methods;
	}

}


// Add custom action links
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'spyr_authorizenet_aim_action_links_mg' );
function spyr_authorizenet_aim_action_links_mg( $links ) {
	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>',
	);

	// Merge our new link with the default ones
	return array_merge( $plugin_links, $links );	
}

?>