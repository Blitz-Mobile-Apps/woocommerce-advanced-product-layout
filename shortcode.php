<?php
function woo_custom_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'category' => '',
		'count' => '6'
	), $atts );
	$content = '';
	$content .='<div id="wooclass">';
	$content .='<div class="row">';
	if (empty($atts['category'])) {
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $atts['count'],
		);
	}else{
		$args = array(
			'post_type' => 'product',
			'product_cat' => $atts['category'],
			'posts_per_page' => $atts['count'],
		);
	}
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) {
		$i = 0;
		while ( $loop->have_posts() ) : $loop->the_post();
			if ( has_post_thumbnail() ) {
				$src = wp_get_attachment_image_src(get_post_thumbnail_id(),'woothumb', true);
				$link = $src[0];
			} else {
				$link =  wc_placeholder_img_src();
			}
			$currency = get_woocommerce_currency_symbol();
			$price_check = get_post_meta( get_the_ID(), '_regular_price', true);
			$sale = get_post_meta( get_the_ID(), '_sale_price', true);
			$price = '';
			if (!empty($price_check)) {
				$price = $currency.get_post_meta(get_the_ID(),'_regular_price',true);
			}
			$unique = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0,3);
			$content .= '
			<div class="'.woo_get_option('productcolm').'">
			<div class="row">
			<div class="col-md-4"><img src="'.$link.'" alt="" class="menu-sec"></div>
			<div class="col-md-8">
			<h4 class="eggs-txt">'.get_the_title().'<span>'.$price.'</span></h4>
			<p>'.substr(get_the_content(), 0 , woo_get_option('text-count')).' <a href="#" data-featherlight="'.WOOURL.'pop.php?id='.get_the_ID().'">'.woo_get_option('popupbtn').'</a></p>
			<a class="cartbtn" data-proid="'.get_the_ID().'" href="javascript:;">add to cart</a>
			</div>
			</div>
			</div>
			';
			$i++;
		endwhile;
		$content .= '</div>';
		$content .= '</div>';
		return $content;
	} else {
		echo __( 'No products found' );
	}
}
add_shortcode( 'product_custom_shortcode','woo_custom_shortcode' );
/**
* Enqueue scripts
*
* @param string $handle Script name
* @param string $src Script url
* @param array $deps (optional) Array of script names on which this script depends
* @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
* @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
*/
function woo_theme_name_scripts() {
	wp_enqueue_script( 'feetherPop', WOOASSETS . 'featherlight-master/release/featherlight.min.js', array( 'jquery' ), '1.1', true);
	wp_enqueue_script( 'bxslider', WOOASSETS . 'bxslider/jquery.bxslider.min.js', array( 'jquery' ), '1.1', true);
	wp_enqueue_script( 'custom', WOOASSETS . 'bxslider/custom.js', array( 'jquery' ), '1.1', true);
}
add_action( 'wp_enqueue_scripts', 'woo_theme_name_scripts' );
function woo_priority()
{
	wp_enqueue_style( 'feetherPop_Css', WOOASSETS . 'featherlight-master/release/featherlight.min.css');
	wp_enqueue_style( 'custom_bootstrap', WOOASSETS . 'css/ui-bootstrap.css', 100);
}
add_action( 'wp_head', 'woo_priority', 10 );
?>