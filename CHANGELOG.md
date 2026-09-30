# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.0] - 2026-09-29

### Changed
- Adopted the Prolific plugin standard. Updates now come from the Prolific Digital license server (`api.prolificdigital.io`). Set `PROLIFIC_LICENSE_KEY_WOOCOMMERCE_ADD_TO_CART` in `wp-config.php` (or use the `prolific_license_key` filter) to receive updates.
- The main file is renamed from `index.php` to `woocommerce-add-to-cart.php`. Reactivate the plugin once after updating.
- Declares `Requires Plugins: woocommerce`.
- License is GPL-2.0-or-later (the bundled LICENSE file was GPL-3.0 text).
- Requires WordPress 6.5+ and PHP 8.4+.

### Added
- `WOOCOMMERCE_ADD_TO_CART_VERSION` constant, ABSPATH guard, text domain `woocommerce-add-to-cart` and translation loading from `languages/`.
- `CHANGELOG.md`, `readme.txt`, coding-standards config and CI/release workflows.

## [1.0.0] - 2023-12-03

### Added
- Initial release: `?add-to-cart=ID:QTY,ID:QTY` adds several products at once, and `metadata_<key>=v1,v2` parameters attach per-item metadata that shows in the cart and is saved on order items.

[Unreleased]: https://github.com/prolific-digital/woocommerce-add-to-cart/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/prolific-digital/woocommerce-add-to-cart/compare/8ade145...v1.1.0
[1.0.0]: https://github.com/prolific-digital/woocommerce-add-to-cart/commit/8ade145
