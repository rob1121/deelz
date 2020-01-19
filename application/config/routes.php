<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

require_once( BASEPATH .'database/DB.php' );
$db =& DB();

// Routes category
$categories = $db->get(PREFIXDB.'categories')->result();

if($categories) {
    foreach($categories as $category) {
        $route[$category->route] = 'deals/category_list/'.$category->id;
    }
}

// Routes Listing deals SubCategory
$sub_categories = $db->get('sub_categories')->result();
if($sub_categories) {
    foreach($sub_categories as $sub_category) {
        $route[$sub_category->route] = 'deals/list_deals/'.$sub_category->id;
        $route[$sub_category->route.'/(:num)'] = 'deals/list_deals/'.$sub_category->id.'/$1';
    }
}

$route['(:any)/bon-plan-reunion/(:num)'] = 'deals/deal/$2';
$route['boutique/(:any)/(:num)'] = 'store/showroom/$2';
$route['comingsoon'] = 'home/comingsoon';
$route['comment-ca-marche'] = 'home/concept';
$route['les-commerces/(:num)'] = 'store/listing/$1';
$route['les-commerces'] = 'store/listing';