<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "admin";
$route['404_override'] = '';

$route['apilogin'] = 'api/login';
$route['apisignup'] = 'api/register';
$route['apiactivate'] = 'api/activate';
$route['apicategories'] = 'api/categories';
$route['apilanding'] = 'api/landing';
$route['apiactivities'] = 'api/activitylist';
$route['apivenuedetails'] ='api/venuedetails';
$route['apivenuefacilities'] ='api/facilities';
$route['apirating']='api/rating';
$route['apireview']='api/review';
$route['apiuserlike']='api/userlike';
$route['apivenuesearch']='api/venuesearch';
$route['apivenueslots']='api/slots';
$route['apifacilitypricing']='api/facilitypricing';
$route['apiprofileupdate']='api/profileupdate';
$route['apibookinghistory']='api/bookinghistory';
$route['apiforgotpass']='api/forgotpassword';
$route['apisubcategories']='api/subcategories';
$route['apisubsubcatlist']='api/subsubcatlist';
$route['apibookinglocations']='api/bookinglocations';
$route['apivenuedetailsnew']='api/venuedetailsnew';
$route['apivenuesubsubcategories']='api/getvenuesubsubcategories';
/* End of file routes.php */
/* Location: ./application/config/routes.php */