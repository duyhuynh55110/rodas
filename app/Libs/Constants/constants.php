<?php
defined('ADMIN_MODULE_AS') or define('ADMIN_MODULE_AS', 'admin.');
defined('ADMIN_GUARD') or define('ADMIN_GUARD', 'admin');
defined('ADMIN_ASSET_PATH') or define('ADMIN_ASSET_PATH', 'admin-lte/');

// Storage
defined('STORAGE_IMAGE_QUANTITY') or define('STORAGE_IMAGE_QUANTITY', 90);
defined('STORAGE_IMAGE_ALLOW_EXTENSION') or define('STORAGE_IMAGE_ALLOW_EXTENSION', '/\.([^.]*)(jpg|jpeg|png)$/i');
defined('STORAGE_SUFFIX_ORIGINAL_RESIZE') or define('STORAGE_SUFFIX_ORIGINAL_RESIZE', '_original$0');
defined('STORAGE_PATH_TO_BRANDS') or define('STORAGE_PATH_TO_BRANDS', 'brands/');
defined('STORAGE_PATH_TO_PRODUCTS') or define('STORAGE_PATH_TO_PRODUCTS', 'products/');

// Resize width & height
defined('RESIZE_BRAND_WIDTH') or define('RESIZE_BRAND_WIDTH', 300);
defined('RESIZE_BRAND_HEIGHT') or define('RESIZE_BRAND_HEIGHT', 300);
defined('RESIZE_PRODUCT_WIDTH') or define('RESIZE_PRODUCT_WIDTH', 300);
defined('RESIZE_PRODUCT_HEIGHT') or define('RESIZE_PRODUCT_HEIGHT', 400);

// select option all
defined('SELECT_OPTION_ALL') or define('SELECT_OPTION_ALL', -1);
