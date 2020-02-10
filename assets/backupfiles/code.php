
// function dolly_css() {
// 	echo "
// 	<style type='text/css'>
// 	#dolly {
// 		float: $x;
// 		padding-$x: 15px;
// 		padding-top: 5px;		
// 		margin: 0;
// 		font-size: 11px;
// 	}
// 	</style>
// 	";
// }
// add_action( 'admin_head', 'dolly_css' );




// when pluin installation
register_activation_hook(__FILE__, 'woo_advanced_assentials_installation');

// when pluin deactivate
register_deactivation_hook(__FILE__, 'msp_helloworld_deactivation');

function woo_advanced_assentials_installation() {
	$cnss_esi_settings = array(
		'key' => 'value',
	);

	foreach ($cnss_esi_settings as $key => $value) {
		add_option( trim($key), trim($value) );
	}
}

function msp_helloworld_deactivation() {    
	// actions to perform once on plugin deactivation go here	    
}