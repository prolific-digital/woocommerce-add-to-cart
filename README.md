# WooCommerce - Add to Cart Multiple Products with Metadata

![Plugin Version](https://img.shields.io/badge/Version-1.1.0-brightgreen.svg)
![WordPress Compatibility](https://img.shields.io/badge/WordPress-6.5%2B-blue.svg)
![WooCommerce Compatibility](https://img.shields.io/badge/WooCommerce-4.0%2B-blue.svg)
![License](https://img.shields.io/badge/License-GPL--2.0--or--later-red.svg)

## Description

This WooCommerce plugin allows you to add multiple products to the cart with metadata from a single URL using the "add-to-cart" parameter. It enhances the shopping experience by enabling customers to quickly add multiple products to their cart with custom metadata.

## Installation

1. Download `woocommerce-add-to-cart.zip` from the latest [GitHub release](https://github.com/prolific-digital/woocommerce-add-to-cart/releases). Requires WordPress 6.5+, PHP 8.4+ and WooCommerce.
2. Log in to your WordPress admin panel.
3. Navigate to **Plugins » Add New » Upload Plugin**.
4. Click the **Choose File** button and select the plugin zip file.
5. Click **Install Now** and then **Activate** the plugin.

## Usage

### Adding Multiple Products with Metadata

To add multiple products to the cart with metadata, you can construct a URL with the "add-to-cart" parameter. The format should be `add-to-cart=product_id:quantity&metadata_key1=value1,value2&metadata_key2=value3`.

For example:

- `https://yourwebsite.com/?add-to-cart=1:2,2:3&metadata_color=red,green&metadata_size=large,medium`

This URL will add two products with ID 1 and 2, each with a specified quantity and custom metadata.

### Customizing Cart Display

The plugin provides customization options for displaying custom item data in the cart. You can modify the display format according to your needs.

### Adding Metadata to Order

Custom metadata associated with products will be added to the order for reference. This information can be useful for order processing and fulfillment.

## Updates

Updates are served by the Prolific Digital license server. Add the site's license key to `wp-config.php`:

```php
define( 'PROLIFIC_LICENSE_KEY_WOOCOMMERCE_ADD_TO_CART', 'your-key' );
```

You can also supply the key with the `prolific_license_key` filter, which receives `( $key, 'woocommerce-add-to-cart' )`.

## Development

The dev site is the DDEV sandbox at `https://wp-sandbox.ddev.site`. Run commands in the container:

```sh
ddev exec -d /var/www/html/wp-content/plugins/woocommerce-add-to-cart composer install
ddev exec -d /var/www/html/wp-content/plugins/woocommerce-add-to-cart composer lint    # php -l on every file
ddev exec -d /var/www/html/wp-content/plugins/woocommerce-add-to-cart composer phpcs   # WordPress-Extra + PHPCompatibilityWP
```

`vendor/` is not committed. A git checkout needs `composer install` before the updater loads. The plugin itself still runs without it.

## Releasing

1. Bump the version in the plugin header, `WOOCOMMERCE_ADD_TO_CART_VERSION` and `readme.txt` `Stable tag`.
2. Add a `## [x.y.z] - YYYY-MM-DD` section to `CHANGELOG.md` and a `= x.y.z =` entry to `readme.txt`.
3. Merge to `main`, then push a `vx.y.z` tag. The release workflow builds `woocommerce-add-to-cart.zip` (with `composer install --no-dev`, honoring `.distignore`) and attaches it to a GitHub Release.

CI and release logic live in the shared workflows in [`prolific-digital/.github`](https://github.com/prolific-digital/.github).
## Stored data

No options. Metadata passed in the URL is saved as order item meta (business data, kept on uninstall).

## Author

- **Prolific Digital**
- Website: [https://prolificdigital.com/](https://prolificdigital.com/)

## Support and Contribution

If you have any questions, issues, or suggestions, please feel free to create an [issue](https://github.com/prolific-digital/woocommerce-add-to-cart/issues) on the GitHub repository.

We welcome contributions to improve and enhance this plugin. If you'd like to contribute, please fork the repository and submit a pull request.

Happy shopping with WooCommerce!
