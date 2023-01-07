<?php

defined('ADMIN_MODULE_AS') or define('ADMIN_MODULE_AS', 'admin.');
defined('USER_GUARD') or define('USER_GUARD', 'user');
defined('ADMIN_ASSET_PATH') or define('ADMIN_ASSET_PATH', 'admin-lte/');

// Storage
defined('STORAGE_IMAGE_QUANTITY') or define('STORAGE_IMAGE_QUANTITY', 90);
defined('STORAGE_IMAGE_ALLOW_EXTENSION') or define('STORAGE_IMAGE_ALLOW_EXTENSION', '/\.([^.]*)(jpg|jpeg|png)$/i');
defined('STORAGE_SUFFIX_ORIGINAL_RESIZE') or define('STORAGE_SUFFIX_ORIGINAL_RESIZE', '_original$0');
defined('STORAGE_PATH_TO_BRANDS') or define('STORAGE_PATH_TO_BRANDS', 'brands/');
defined('STORAGE_PATH_TO_PRODUCTS') or define('STORAGE_PATH_TO_PRODUCTS', 'products/');
defined('STORAGE_PATH_TO_PRODUCT_SLIDES') or define('STORAGE_PATH_TO_PRODUCT_SLIDES', 'product-slides/');
defined('STORAGE_PATH_TO_GIFT_BOXES') or define('STORAGE_PATH_TO_GIFT_BOXES', 'gift-boxes/');

// Resize width & height
defined('RESIZE_BRAND_WIDTH') or define('RESIZE_BRAND_WIDTH', 300);
defined('RESIZE_BRAND_HEIGHT') or define('RESIZE_BRAND_HEIGHT', 300);
defined('RESIZE_PRODUCT_WIDTH') or define('RESIZE_PRODUCT_WIDTH', 300);
defined('RESIZE_PRODUCT_HEIGHT') or define('RESIZE_PRODUCT_HEIGHT', 400);
defined('RESIZE_PRODUCT_SLIDE_WIDTH') or define('RESIZE_PRODUCT_SLIDE_WIDTH', 400);
defined('RESIZE_PRODUCT_SLIDE_HEIGHT') or define('RESIZE_PRODUCT_SLIDE_HEIGHT', 600);
defined('RESIZE_GIFT_BOXES_WIDTH') or define('RESIZE_GIFT_BOXES_WIDTH', 500);
defined('RESIZE_GIFT_BOXES_HEIGHT') or define('RESIZE_GIFT_BOXES_HEIGHT', 500);

// select option all
defined('SELECT_OPTION_ALL') or define('SELECT_OPTION_ALL', -1);

// maximum number value
defined('MAX_INTEGER_VALUE') or define('MAX_INTEGER_VALUE', 2147483647);

// Resize image
defined('UPLOAD_MAX_SIZE') or define('UPLOAD_MAX_SIZE', 5242880); // BYTES (maximum is 5MB)

// Http Code
// https://developers.rebrandly.com/docs/http-responses
defined('HTTP_CODE_OK') or define('HTTP_CODE_OK', 200);
defined('HTTP_CODE_UNPROCESSABLE_ENTITY') or define('HTTP_CODE_UNPROCESSABLE_ENTITY', 422);
defined('HTTP_CODE_INTERNAL_SERVER_ERROR') or define('HTTP_CODE_INTERNAL_SERVER_ERROR', 500);
defined('HTTP_CODE_UNAUTHORIZED') or define('HTTP_CODE_UNAUTHORIZED', 401);
defined('HTTP_CODE_NOT_FOUND') or define('HTTP_CODE_NOT_FOUND', 404);

// Status code
defined('STATUS_CODE_LOGIN_FAILED') or define('STATUS_CODE_LOGIN_FAILED', 104);
defined('STATUS_CODE_NOT_LOGGED_IN') or define('STATUS_CODE_NOT_LOGGED_IN', 103); // still not login

// Status code (status is custom define, handle exception from RESTFUL API)
defined('STATUS_CODE_INVALID_REQUEST') or define('STATUS_CODE_INVALID_REQUEST', 100);

// Token name
defined('TOKEN_NAME_API') or define('TOKEN_NAME_API', 'Api');

// Created by system (set when creating/updating on a model without admin role)
defined('CREATED_BY_SYSTEM') or define('CREATED_BY_SYSTEM', 0);

// Token type
defined('TOKEN_TYPE_BEARER') or define('TOKEN_TYPE_BEARER', 'Bearer');

// account role
defined('ACCOUNT_ROLE_ADMIN') or define('ACCOUNT_ROLE_ADMIN', 1);
defined('ACCOUNT_ROLE_USER') or define('ACCOUNT_ROLE_USER', 2);

// user notification type
defined('NOTIFICATION_TYPE_NORMAL') or define('NOTIFICATION_TYPE_NORMAL', 1);
defined('NOTIFICATION_TYPE_SUCCESS') or define('NOTIFICATION_TYPE_SUCCESS', 2);

//  user notification read status
defined('NOTIFICATION_IS_READ_OFF') or define('NOTIFICATION_IS_READ_OFF', 0);
defined('NOTIFICATION_IS_READ_ON') or define('NOTIFICATION_IS_READ_ON', 1);

