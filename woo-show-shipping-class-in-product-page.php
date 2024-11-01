<?php
/**
*@package show-shipping-class-in-product-page
*/
/*
Plugin Name: Show Shipping Class in Product Page
Plugin URI: https://theplanp.com/plugins/woocommece-show-shipping-class-in-product-page/
Description: This enables you to display the shipping class of product on the product page.
Version: 1.2.0
Author: Paul Plantzos
Author URI: https://paulplantzos.com
Donate: https://paypal.me/planp?locale.x=en_US
License: GPLv2 or later
Text Domain: Show Shipping Class in Product Page
*/

/*
Copyright (C) 2020  Paul Plantzos

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! function_exists( 'add_action') ) {
	echo "Hello, this is weird!";
	exit;
}


add_action('woocommerce_single_product_summary', 'display_product_shipping_class', 15 );
function display_product_shipping_class(){
    global $product;
    
    $shipping_class = $product->get_shipping_class();

    if( ! empty($shipping_class) ) {
        $term = get_term_by( 'slug', $shipping_class, 'product_shipping_class' );
    
        if( is_a($term, 'WP_Term') ){
            echo '<p class="product-shipping-class">' . $term->name . '</p>';
        }
    }
}

/**
 * Display Shipping Classes in Product Catalogue too. If you don't need this option simply remove this piece of code.
 */

add_action('woocommerce_after_shop_loop_item_title', 'display_product_shipping_class_catalogue', 10 );
function display_product_shipping_class_catalogue(){
    global $product;
    
    $shipping_class = $product->get_shipping_class();

    if( ! empty($shipping_class) ) {
        $term = get_term_by( 'slug', $shipping_class, 'product_shipping_class' );
    
        if( is_a($term, 'WP_Term') ){
            echo '<p class="product-shipping-class-catalogue">' . $term->name . '</p>';
        }
    }
}