<?php require_once '../../../wp-load.php';
$productId = $_GET['id'];
global $post, $product, $woocommerce;
$product = wc_get_product( $productId );
?>
<div id="wooclass">
	<div class="row pop">
		<div class="col-md-5">
			<?php
			$product_attach_ids = $product->get_gallery_attachment_ids(); ?>
			<?php if ($product_attach_ids): ?>
				<div id="bx-pager">
					<?php
					$i = 0;
					foreach ($product_attach_ids as $product_attach_id):
						$thumbnail1 = wp_get_attachment_image_src($product_attach_id,'woothumb', true); ?>
						<a data-slide-index="<?php echo $i; ?>" href=""><img src="<?php echo $thumbnail1[0]; ?>"></a>
						<?php
						$i++;
						endforeach ?>
					</div>
				<?php endif ?>
				<?php if ($product_attach_ids): ?>
					<ul class="bxslider">
						<?php foreach ($product_attach_ids as $product_attach_id):
						$thumbnail1 = wp_get_attachment_image_src($product_attach_id,'shop_catalog', true); ?>
						<li><img src="<?php echo $thumbnail1[0]; ?>"></li>
					<?php endforeach ?>
				</ul>
			<?php else:
			$src = wp_get_attachment_image_src(get_post_thumbnail_id($productId),'shop_catalog', true); ?>
			<img src="<?php echo $src[0]; ?>" alt="">
		<?php endif; ?>
		<script>
			jQuery('.bxslider').bxSlider({
				pagerCustom: '#bx-pager'
			});
		</script>
	</div>
	<div class="col-md-7">
		<h2><?php echo $product->get_title(); ?></h2>
		<hr>
		<div class="wooprice"><?php echo $product->get_price_html(); ?></div>
		<p>
			<?php echo get_post_field('post_content', $productId); ?>
		</p>
		<form class="cartwoo" action="" method="post" enctype="multipart/form-data">
			<div class="quantity">
				<input type="button" value="-" class="minuswoo">
				<input type="hidden" name="action" value="woo_addtocart">
				<input type="number" class="input-text qty text" step="1" min="1" max="" name="qty" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
				<input type="button" value="+" class="pluswoo">
				<input type="hidden" name="proid" value="<?php echo $productId; ?>">
			</div>
			<button type="submit" style="border-radius: 3px !important;"><?php echo $product->single_add_to_cart_text(); ?></button>
		</form>
		<div class="clearfix"></div>
		<div class="alert woo_addtocart" style="margin-top: 15px;">
		</div>
	</div>
</div>
</div>
<?php  ?>