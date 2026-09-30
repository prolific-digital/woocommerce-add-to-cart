<?php

/**
 * Plugin Name: WooCommerce - Add to Cart Multiple Products with Metadata
 * Description: Add multiple products to the cart with metadata from a single URL using the "add-to-cart" parameter.
 * Version: 1.0
 * Author: Prolific Digital
 */

class AddToCartWithMetadata {

  /**
   * Constructor for the class.
   * Initializes actions and filters.
   */
  public function __construct() {
    // Add action to handle adding multiple products to the cart
    add_action('wp_loaded', array($this, 'add_multiple_products'));

    // Add filter to handle cart item data
    add_filter('woocommerce_add_cart_item_data', array($this, 'add_cart_item_data'), 10, 3);

    // Add filter to display custom item data in the cart
    add_filter('woocommerce_get_item_data', array($this, 'get_item_data'), 10, 2);

    // Add action to add custom meta to order items
    add_action('woocommerce_checkout_create_order_line_item', array($this, 'add_custom_meta_to_order_items'), 10, 4);
  }

  /**
   * Add multiple products to the cart with metadata.
   *
   * @return void
   */
  public function add_multiple_products() {
    if (isset($_GET['add-to-cart']) && !empty($_GET['add-to-cart'])) {
      $product_data = sanitize_text_field($_GET['add-to-cart']);
      $items = explode(',', $product_data);

      foreach ($items as $item) {
        list($product_id, $quantity) = explode(':', $item);
        $product_id = intval($product_id);
        $quantity = intval($quantity);

        if ($product_id > 0 && $quantity > 0) {
          // Add the product to the cart with custom data
          WC()->cart->add_to_cart($product_id, $quantity);
        }
      }

      wp_safe_redirect(wc_get_cart_url());
      exit;
    }
  }

  /**
   * Handle cart item data.
   *
   * @param array $cartItemData The cart item data.
   * @param int $productId The product ID.
   * @param int $variationId The variation ID.
   *
   * @return array The updated cart item data.
   */
  public function add_cart_item_data($cart_item_data, $product_id, $variation_id) {
    // Initialize an array to store custom data
    $custom_data = array();

    // Parse the 'add-to-cart' parameter to get product IDs in the order they were added
    $added_product_ids = array();
    if (isset($_GET['add-to-cart'])) {
      $product_quantities = explode(',', $_GET['add-to-cart']);
      foreach ($product_quantities as $pq) {
        list($id, $quantity) = explode(':', $pq);
        // for ($i = 0; $i < $quantity; $i++) {
        //   $added_product_ids[] = $id;
        // }
        $added_product_ids[] = $id;
      }
    }

    // Get the index of the current product in the order of addition
    $product_index = array_search($variation_id, $added_product_ids);

    // Loop through the GET parameters to find those with "metadata_" prefix
    foreach ($_GET as $key => $value) {
      // Check if the key starts with "metadata_"
      if (strpos($key, 'metadata_') === 0) {
        // Remove the "metadata_" prefix from the key
        $meta_key = str_replace('metadata_', '', $key);

        // Split comma-separated values
        $meta_values = explode(',', $value);

        // Assign the relevant metadata value to the product based on its index
        if ($product_index !== false && isset($meta_values[$product_index])) {
          $custom_data[$meta_key] = sanitize_text_field($meta_values[$product_index]);
        }
      }
    }

    // Assign the custom data to the cart item data
    if (!empty($custom_data)) {
      $cart_item_data['_custom_data'] = $custom_data;
    }

    return $cart_item_data;
  }

  /**
   * Display custom item data in the cart.
   *
   * @param array $itemData The item data to display.
   * @param array $cartItemData The cart item data.
   *
   * @return array The updated item data.
   */
  public function get_item_data($item_data, $cart_item_data) {

    if (isset($cart_item_data['_custom_data'])) {
      foreach ($cart_item_data['_custom_data'] as $key => $value) {
        // Capitalize the first letter of the key for display
        $display_key = ucfirst($key);

        // Debug: Log item data before returning
        // error_log('Here are the values: ' . print_r($value, true));

        $item_data[] = array(
          'key'   => $display_key,
          'value' => wc_clean($value), // Sanitize the value
        );
      }
    }

    return $item_data;
  }

  /**
   * Add custom meta to order items.
   *
   * @param object $item The order item.
   * @param string $cartItemKey The cart item key.
   * @param array $values The cart item values.
   * @param object $order The order object.
   *
   * @return void
   */
  public function add_custom_meta_to_order_items($item, $cart_item_key, $values, $order) {
    if (isset($values['_custom_data'])) {
      foreach ($values['_custom_data'] as $key => $values_array) {
        // Capitalize the first letter of the key for display
        $display_key = ucfirst($key);

        // Debug: Log item data before returning
        error_log('Item data: ' . print_r($values_array, true));

        $item->add_meta_data(
          $display_key,
          wc_clean($values_array), // Sanitize the value
          true
        );

        // Check if $values_array is an array and not empty
        if (is_array($values_array) && !empty($values_array)) {

          // Loop through each value in the array and add it to the order item's metadata
          foreach ($values_array as $value) {
            $item->add_meta_data(
              $display_key,
              wc_clean($value), // Sanitize the value
              true
            );
          }
        }
      }
    }
  }
}

// Create an instance of the class to initialize the hooks
new AddToCartWithMetadata();
