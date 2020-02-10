<?php
function woocommerce_custom_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'category' => 'feature',
		'count' => '6'
	), $atts );


$content = '';

$content .='<div class="col span_12">';
$args = array(
	'post_type' => 'product',
	'product_cat' => $atts['category'],
	'posts_per_page' => $atts['count'],
	);
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) {
	$i = 0;

	while ( $loop->have_posts() ) : $loop->the_post();
	if ( has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src(get_post_thumbnail_id(),'thumbnail', true);
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



global $post, $product, $woocommerce;
$gallery = '';
$product_attach_ids = $product->get_gallery_attachment_ids();

if ( $product_attach_ids ) {

	$gallery .= '<div class="slide">';
	foreach ($product_attach_ids as $product_attach_id) {
		$thumbnail1 	= wp_get_attachment_image_src($product_attach_id,'thumbnail', true);
		$gallery .=    '<div class="easyzoom"><a href="'.$thumbnail1[0].'"><img src="'.$thumbnail1[0].'"></a></div>';
		// $gallery .=    '<br>'.$product_attach_id.'';
	}
	$gallery .= '</div>';
}





$content .= '
	<div class="col span_6" style="float: right;margin: 0;width: 50%;">
		<div class="row">
			<div class="col span_4"><img src="'.$link.'" alt="" class="menu-sec"></div>
			<div class="col span_8">
				<h4 class="eggs-txt">'.get_the_title().'<span>'.$price.'</span></h4>
				<p>'.substr(get_the_content(), 0 , 75).' <a href="#" data-featherlight=".ajaxcontent'.$i.$unique.'">[...]</a></p>
				<a class="cartbtn" href="?add-to-cart='.get_the_ID().'">add to cart</a>
			</div>
		</div>
	</div>
	<div class="ajaxcontent'.$i.$unique.' displaynone">
		<h2>'.get_the_title().'<span style="color: #a81e22;">&nbsp;&nbsp;&nbsp;'.$price.'</span></h2>
		<a class="cartbtn" href="?add-to-cart='.get_the_ID().'">add to cart</a>
		<p>'.get_the_content().'</p>
		<br>
		'.$gallery.'
	</div>
	';
	$i++;
	endwhile;
	$content .= '</div>';

return $content;


} else {
echo __( 'No products found' );
}
}
add_shortcode( 'product_custom_shortcode','woocommerce_custom_shortcode' );




/**
* Enqueue scripts
*
* @param string $handle Script name
* @param string $src Script url
* @param array $deps (optional) Array of script names on which this script depends
* @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
* @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
*/
function theme_name_scripts() {
wp_enqueue_script( 'feetherPop', get_template_directory_uri() . '/inc/featherlight-master/release/featherlight.min.js', array( 'jquery' ), '1.1', true);
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

wp_enqueue_style( 'custome', get_template_directory_uri() . '/inc/featherlight-master/release/featherlight.min.css');




?>