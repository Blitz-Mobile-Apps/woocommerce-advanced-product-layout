<form method="post" action="options.php" enctype="multipart/form-data">
	<?php settings_fields( 'woo-settings-group' ); ?>
	<h2>Woocommerce Advanced Product Setting</h2>
	<table class="form-table">
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">PopUp Button Text</th>
			<td><input type="text" name="popupbtn" id="popupbtn" value="<?php echo woo_get_option('popupbtn') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Product Column</th>
			<td>
				<select name="productcolm" id="productcolm">
					<option value="<?php echo woo_get_option('productcolm') ?>"><?php echo woo_get_option('productcolm') ?></option>
					<option value="col-md-1">col-md-1</option>
					<option value="col-md-2">col-md-2</option>
					<option value="col-md-3">col-md-3</option>
					<option value="col-md-4">col-md-4</option>
					<option value="col-md-5">col-md-5</option>
					<option value="col-md-6">col-md-6</option>
					<option value="col-md-7">col-md-7</option>
					<option value="col-md-8">col-md-8</option>
					<option value="col-md-9">col-md-9</option>
					<option value="col-md-10">col-md-10</option>
					<option value="col-md-11">col-md-11</option>
					<option value="col-md-12">col-md-12</option>
				</select>
			</td>
		</tr>
		<!-- <tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr> -->
	</table>
	<p class="submit" style="text-align:left"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
</form>
<form method="post" action="options.php" enctype="multipart/form-data">
	<?php settings_fields( 'woo-pop-up-settings-group' ); ?>
	<h2>Popup Setting</h2>
	<table class="form-table">
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Bg color</th>
			<td><input type="text" name="woo-popup" id="woo-popup" value="<?php echo woo_get_option('woo-popup') ?>" /></td>
		</tr>
		<!-- <tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr>
		<tr class="wrap-icon-bg-color" valign="top">
			<th scope="row">Text Count</th>
			<td><input type="text" name="text-count" id="text-count" value="<?php echo woo_get_option('text-count') ?>" /></td>
		</tr> -->
	</table>
	<p class="submit" style="text-align:left"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
</form>
<div class="container">
	<div class="row">
		<h2 id="shortcode">How to use</h2>
		<fieldset class="woo_fieldset">
			<legend><h4 class="sec-title">Using Shortcode</h4></legend>
			<p>You just need to put the shortcode wherever you want <code>[product_custom_shortcode]</code></p>
			<p>If you want product from specific category you can use<code>[product_custom_shortcode category="lunch"]</code></p>
			<p>If you want product count you can use <code>[product_custom_shortcode category="lunch" count="6"]</code></p>
		</fieldset>
	</div>
</div>