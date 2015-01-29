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

$route['default_controller'] = "login";
$route['404_override'] = 'administrator/error';
$route['office']			= "administrator/office";
$route['deleteOffice']		= "administrator/deleteOffice";
$route['editOffice']		= "administrator/editOffice";
$route['addOffice']		= "administrator/addOffice";
$route['addOfficeForm']		= "administrator/addOfficeForm";

$route['officeHead']			= "administrator/officeHead";
$route['addOfficeHead']			= "administrator/addOfficeHead";
$route['addOfficeHeadForm']			= "administrator/addOfficeHeadForm";
$route['changeStatusOfficeHead']	= "administrator/changeStatusOfficeHead";
$route['editOfficeHead']			= "administrator/editOfficeHead";
$route['editOfficeHeadForm/(:num)']			= "administrator/editOfficeHeadForm";

$route['officeSecretary']			= "administrator/officeSecretaries";
$route['addOfficeSecretary']			= "administrator/addOfficeSecretary";
$route['addOfficeSecretaryForm']			= "administrator/addOfficeSecretaryForm";
$route['fileUploadForm']			= "secretary/fileUploadForm";
$route['fileUpload']			= "secretary/fileUpload";
$route['fileDownload']			= "secretary/fileDownload";

$route['employee']			= "Employee/index";
$route['editOfficeSecretary']			= "administrator/editOfficeSecretary";
$route['editOfficeSecretaryForm/(:num)']			= "administrator/editOfficeSecretaryForm";
$route['changeStatusOfficeSecretary']	= "administrator/changeStatusOfficeSecretary";

$route['logout']			= "login/logout";
$route['OfficeSecretary']			= "secretary";
$route['createFolder']			= "secretary/createFolder";
$route['profile/(:num)']			= "administrator/profile";
$route['edit-profile/(:num)']			= "administrator/editProfile";
$route['save-personal-information']			= "administrator/savePersonalInformation";
$route['save-user-credentials']			= "administrator/saveUserCredentials";
$route['edit-office-head-password/(:num)']			= "administrator/editOfficeHeadPassword";
$route['update-office-head-password']			= "administrator/updateOfficeHeadPassword";
$route['edit-office-secretary-password/(:num)']			= "administrator/editOfficeSecretaryPassword";
$route['update-office-secretary-password']			= "administrator/updateOfficeSecretaryPassword";

/* End of file routes.php */
/* Location: ./application/config/routes.php */