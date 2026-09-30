=== WooCommerce - Add to Cart Multiple Products with Metadata ===
Contributors: prolificdigital
Tags: woocommerce, add to cart, cart, url, metadata
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.4
Requires Plugins: woocommerce
Stable tag: 1.1.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds multiple products to the WooCommerce cart, with per-item metadata, from a single add-to-cart URL.

== Description ==

Build a link such as:

`https://example.com/?add-to-cart=1:2,2:3&metadata_color=red,green&metadata_size=large,medium`

Each `ID:QTY` pair is added to the cart, then the visitor is redirected to the cart. Each `metadata_<key>` parameter holds comma-separated values in the same order as the products; the matching value is attached to the cart item, shown in the cart and saved as order item meta.

== Installation ==

1. Upload the `woocommerce-add-to-cart` folder to `/wp-content/plugins/`, or install the release zip from **Plugins > Add New > Upload Plugin**.
2. Activate the plugin. WooCommerce must be active.
3. To receive automatic updates, add your license key to `wp-config.php`:
   `define( 'PROLIFIC_LICENSE_KEY_WOOCOMMERCE_ADD_TO_CART', 'your-key' );`

== Changelog ==

= 1.1.0 =
* Updates now come from the Prolific Digital license server. Define `PROLIFIC_LICENSE_KEY_WOOCOMMERCE_ADD_TO_CART` to receive them.
* Main file renamed to `woocommerce-add-to-cart.php`; reactivate the plugin once after updating.
* Declares WooCommerce as a required plugin.
* License is GPL-2.0-or-later. Requires WordPress 6.5+ and PHP 8.4+.

= 1.0.0 =
* Initial release.
