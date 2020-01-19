<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/
$autoload['libraries'] = array('database', 'template', 'session', 'paypal');

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|	$autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array('url', 'date_helper', 'all_helper', 'language');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array('partial', 'home', 'deals', 'mailing', 'store', 'users', 'scripts', 'helpers', 'controllers');

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/
$autoload['model'] = array(
    'Categories_model' => 'categories', 
    'Sub_categories_model' => 'sub_categories', 
    'Deals_model' => 'deals', 
    'Users_pro_model' => 'users_pro', 
    'Users_model' => 'users',
    'Users_favorites_model' => 'users_favorites',
    'Users_cart_model' => 'users_cart',
    'Cities_model' => 'cities',
    'Users_pro_rating_model' => 'users_pro_rating',
    'Providers_model' => 'providers',
    'Orders_model' => 'orders',
    'Orders_deals_model' => 'orders_deals',
    'Boosts_logo_model' => 'boosts_logo',
    'Boosts_newsletter_model' => 'boosts_newsletter',
    'Boosts_photo_model' => 'boosts_photo',
    'Boosts_social_model' => 'boosts_social',
    'Boosts_zotdeal_model' => 'boosts_zotdeal',
    'Stats_views_model' => 'stats_views',
    'Stats_views_details_model' => 'stats_views_details',
    'Coupons_printed_model' => 'coupons_printed',
    'Inbox_model' => 'inbox',
    'Comingsoon_pro_model' => 'comingsoon_pro',
    'Quotations_model' => 'quotations',
    'Users_pro_orders_model' => 'users_pro_orders',
    'Cms_model' => 'cms',
    'Config_db_model' => 'config_db',
    );
