<?php
/**
 * Generates banners for Sitewide Sale
 *
 * @package pmpro-sitewide-sale/includes
 */

add_action( 'wp', 'pmpro_sws_init_banners' );
/**
 * Logic for when to show banners/which banner to show
 */
function pmpro_sws_init_banners() {
	$options = pmprosws_get_options();
	if ( false !== $options['discount_code_id'] &&
				false !== $options['landing_page_post_id'] &&
				'no' !== $options['use_banner'] &&
				! is_page( intval( $options['landing_page_post_id'] ) ) &&
				! ( $options['hide_on_checkout'] && is_page( $pmpro_pages['checkout'] ) ) &&
				! in_array( pmpro_getMembershipLevelForUser()->ID, $options['hide_for_levels'], true )
			) {

		// Display the appropriate banner
		// $options['use_banner'] will be something like top, bottom, etc.
		if ( file_exists( PMPROSWS_DIR . '/includes/banners/' . $options['use_banner'] . '.php' ) ) {
			require_once PMPROSWS_DIR . '/includes/banners/' . $options['use_banner'] . '.php';
			// Maybe call a function here...
		}
	}
}