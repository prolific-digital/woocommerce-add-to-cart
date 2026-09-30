<?php
/**
 * Automatic updates from the Prolific Digital license server.
 *
 * Loaded from the main plugin file after Composer's autoloader. The license
 * key is read from the PROLIFIC_LICENSE_KEY_WOOCOMMERCE_ADD_TO_CART constant
 * (wp-config.php) and can be overridden with the `prolific_license_key` filter.
 *
 * @package WooCommerceAddToCart
 */

defined( 'ABSPATH' ) || exit;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if ( ! class_exists( PucFactory::class ) ) {
	return;
}

( static function (): void {
	$update_checker = PucFactory::buildUpdateChecker(
		'https://api.prolificdigital.io/api/update?plugin=woocommerce-add-to-cart',
		WOOCOMMERCE_ADD_TO_CART_PLUGIN_FILE,
		'woocommerce-add-to-cart'
	);
	$update_checker->addQueryArgFilter(
		static function ( array $args ): array {
			$key = defined( 'PROLIFIC_LICENSE_KEY_WOOCOMMERCE_ADD_TO_CART' ) ? constant( 'PROLIFIC_LICENSE_KEY_WOOCOMMERCE_ADD_TO_CART' ) : '';
			$key = (string) apply_filters( 'prolific_license_key', $key, 'woocommerce-add-to-cart' );
			if ( '' !== $key ) {
				$args['license_key'] = $key;
			}
			return $args;
		}
	);
} )();
