<?php
/**
* @package w_a_p_l
* @version 1.0
*/
/*
Plugin Name: Woocommerce Advanced Product Layout
Plugin URI: #
Description: Woocommerce advanced product layout which will let you create your product in menu style.
Version: 1.0
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: Woo_shortcode
Author URI: #
*/
/*
Copyright (C) Year  Author  Email : charlestsmith888@gmail.com
Woocommerce Advanced plugin layout is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
Woocommerce Advanced plugin layout is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with Woocommerce Advanced plugin layout; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define('WOOURL', plugins_url('/woocommerce-advanced-product/'));
define('WOOASSETS', plugins_url('/woocommerce-advanced-product/assets/'));
// Shortcode
require 'shortcode.php';
// get options custom
if (!function_exists('woo_get_option')) {
	function woo_get_option($key='') {
		if ($key == '') {
			return;
		}
		$woo_settings = array(
			'text-count' => 75,
			'productcolm' => 'col-md-6',
			'popupbtn' => '[...]',
			'woo-popup' => 'red'
		);
		if ( get_option($key) != '' ) {
			return get_option($key);
		} else {
			return $woo_settings[$key];
		}
	}
}
// Set image thumb
add_filter( 'intermediate_image_sizes_advanced','woo_set_thumbnail_size_by_post_type', 10);
function woo_set_thumbnail_size_by_post_type( $sizes ) {
	$post_type = get_post_type($_REQUEST['post_id']);
	switch ($post_type) :
	case 'product' :
	$sizes['woothumb'] = array(
		'width' => 150,
		'height' => 90,
		'crop' => true
	);
	break;
	endswitch;
	return $sizes;
}
// Ajax Action start from here
add_action( 'wp_ajax_woo_addtocart', 'woo_myajax_submit' );
add_action( 'wp_ajax_nopriv_woo_addtocart', 'woo_myajax_submit' );
function woo_myajax_submit() {
	$id = $_POST['proid'];
	$qty = $_POST['qty'];
	$product_id = $_POST['proid'];
	$found = false;
	if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
		foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['product_id'];
			if ( $_product == $product_id ){
				$found = true;
				$response = json_encode(array( 'class1' => 'alert-danger', 'msg' => 'Product is already added into cart'));
			}
		}
		if ( !$found){
			WC()->cart->add_to_cart( $product_id ,$qty);
			$response = json_encode(array( 'class2' => 'alert-success', 'msg' => 'Product has been added into cart'));
		}
	} else {
		WC()->cart->add_to_cart( $product_id ,$qty);
		$response = json_encode(array( 'class3' => 'alert-success', 'msg' => 'Product has been added into cart'));
	}
	header( "Content-Type: application/json" );
	echo $response;
	exit;
}
// If Is admin
if (is_admin()):
// write css in admin
	function woo_admnin_css() {
		echo "
		<style type='text/css'>
		.woo_fieldset {border: 1px solid #ebebeb;padding: 5px 20px;background: #fff;margin-bottom: 40px;-webkit-box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);-moz-box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);}
		.woo_fieldset .sec-title {border: 1px solid #ebebeb;background: #fff;color: #d54e21;padding: 2px 4px;}
		</style>";
	}
	add_action( 'admin_head', 'woo_admnin_css' );
	// Setting Fields
	add_action( 'admin_init', 'woo_register_woo_settings' );
	function woo_register_woo_settings() {
		register_setting( 'woo-settings-group', 'text-count' );
		register_setting( 'woo-settings-group', 'popupbtn' );
		register_setting( 'woo-settings-group', 'productcolm' );
	}
	add_action( 'admin_init', 'woo_pop_register_woo_settings' );
	function woo_pop_register_woo_settings() {
		register_setting( 'woo-pop-up-settings-group', 'woo-popup' );
	}
	// Add Menu
	function woo_add_menu_in_admin() {
		add_menu_page('Woocommerce Advanced Product Setting', 'Woocommerce Advanced Product', 'manage_options', 'woo_settingPage', 'woo_settingPage', 'dashicons-screenoptions' );
	}
	add_action('admin_menu', 'woo_add_menu_in_admin');
	// setting Page
	function woo_settingPage($value='')
	{
		require 'pages/settingpage.php';
	}
	// add scripts and stylesheet into admin page
	if( isset($_GET['page']) ) {
		if($_GET['page']=='settingPage') {
			add_action('admin_enqueue_scripts', 'woo_admin_enqueue' );
		}
	}
	function woo_admin_enqueue() {
		// wp_register_script('woo_js', WOOURL . 'css', array(), '1.0' );
		wp_register_style('Woobootrap', WOOASSETS . 'css/ui-bootstrap.css', false, '1.0');
	}
endif;
?>