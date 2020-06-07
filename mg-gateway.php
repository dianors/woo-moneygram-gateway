<?php
/**
 * Mobile Money Payment Gateway
 *
 * Provides a Mobile Money Payment Gateway.
 *
 * @class 		WC_Gateway_Mobile_Money
 * @extends		WC_Payment_Gateway
 * @version		1.0.0
 * @package		WooCommerce/Classes/Payment
 */
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


class mg extends WC_Order {

    public function __construct($order = 0){
        parent::__construct($order);
    }

}