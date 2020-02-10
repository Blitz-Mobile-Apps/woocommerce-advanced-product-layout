<?php 
require_once '../../../../wp-load.php';

$productId = $_GET['id']; 
global $post, $product, $woocommerce;

$product = wc_get_product( $productId );




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



// echo "<pre>";
// print_r($product );
// echo "</pre>";


?>


<h2><?php echo $product->get_title(); ?></h2>

<h4><?php echo $product->get_price_html(); ?></h4>
<a href="?add-to-cart=<?php echo $productId; ?>">Add to cart</a>
<p></p>

<?php echo $gallery; ?>