<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// DB::listen(function($query){
//     //Imprimimos la consulta ejecutada
//     echo "<pre> {$query->sql } </pre>";
//   });


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::prefix('news')->group(function () {
    Route::get('/', function () {
        return view('news.home');
    })->name('news');
    Route::get('/new-1', function () {
        return view('news.new-1');
    })->name('news-1');
    Route::get('/new-2', function () {
        return view('news.new-2');
    })->name('news-2');
});

Route::prefix('admin')->group(function () {
    Route::get('/i/{module?}', 'admin\AdminController@index')->name("admin");
    // Route::get('usersi', 'admin\UserController@index')->name('admin.users');
    Route::post('users/update', 'admin\UserController@update')->name('users.update');
    Route::get('users-list', 'admin\UserController@usersList')->name('users-list'); 
    Route::post('/register-user','admin\UserController@storeUserAdmin')->name('register-user');
    Route::post('/user-admin/destroy','admin\UserController@destroy')->name('user-admin.destroy');
    Route::get('user-admin/profile-select-lists','admin\ProfileController@profilesSelect2')->name('profile-select-list');
    Route::get('driver_info', 'admin\DriverInformationController@index')->name('admin.driver_info');
    Route::post('driver-info/update', 'admin\DriverInformationController@update')->name('driver-info.update'); 
    Route::get('driver-info-list', 'admin\DriverInformationController@driveInformationList')->name('driver-info-list'); 
    Route::post('driver-info/store','admin\DriverInformationController@store')->name('driver-info.store');
    Route::post('driver-info/destroy','admin\DriverInformationController@destroy')->name('driver-info.destroy');
    Route::post('driver-info/import','admin\DriverInformationController@import')->name('driver-info.import');
    Route::post('driver-info/total-drivers', 'admin\DriverInformationController@getNumberDriversByCompanyR')->name('drivers-info.total-drivers'); 
    Route::post('driver-info/total-vehicles', 'admin\DriverVehicleController@getTotalVehiclesByCompanyR')->name('drivers-info.total-vehicles'); 
    Route::post('driver-info/gender', 'admin\DriverInformationController@getGenderByCompanyR')->name('drivers-info.gender'); 
    Route::post('driver-info/average-score', 'admin\DriverInformationController@getAverageScoreByCompanyR')->name('drivers-info.average-score'); 
    Route::post('driver-info/licence-expiration-number', 'admin\DrivingLicenceController@getLicenceExpiDatesR')->name('drivers-info.licence-expiration-number'); 
    Route::post('driver-info/licence-expirated-number', 'admin\DrivingLicenceController@getLicencesExpiratedR')->name('drivers-info.licence-expirated-number'); 
    Route::post('driver-info/soat-expiration-number', 'admin\VehicleController@getSoatExpiDatesR')->name('drivers-info.soat-expiration-number'); 
    Route::post('driver-info/soat-expirated-number', 'admin\VehicleController@getSoatsExpiratedR')->name('drivers-info.soat-expirated-number'); 
    Route::post('driver-info/technomecanical-expiration-number', 'admin\VehicleController@getExpiTechnomecanicalDatesR')->name('drivers-info.technomecanical-expiration-number'); 
    Route::post('driver-info/technomecanical-expirated-number', 'admin\VehicleController@getExpiTecnomecanicalExpiratedR')->name('drivers-info.technomecanical-expirated-number'); 
    Route::get('driver-info/drivers-select-lists', 'admin\DriverInformationController@getDriveInformationtoSelect2')->name('drivers-select-lists'); 
    Route::get('driver-info/name-driver', 'admin\DriverInformationController@getNameDriver')->name('drivers-get-name'); 
    Route::post('driver-info/education-chart', 'admin\DriverInformationController@makeBarChart')->name('drivers-info.education-chart'); 
    Route::post('driver-info/civil-state-chart', 'admin\DriverInformationController@makeBarChartCivilState')->name('drivers-info.civil-state-chart'); 
    Route::post('driver-info/category-chart', 'admin\DrivingLicenceController@makeBarChartCategory')->name('drivers-info.category-chart'); 
    Route::post('driver-info/licence-state-chart', 'admin\DrivingLicenceController@makeBarChartLicenceState')->name('drivers-info.state-licence-chart'); 
    Route::get('company-search-list', 'admin\CompanyController@getCompanies')->name('company-search-list'); 
    Route::get('company-select-list', 'admin\CompanyController@getCompaniestoSelect2')->name('company-select-list'); 
    Route::get('driving_licence', 'admin\DrivingLicenceController@index')->name('admin.driving_licence');
    Route::get('driving-licence-list', 'admin\DrivingLicenceController@drivingLicenceList')->name('driving-licence-list'); 
    Route::post('driving_licence/destroy','admin\DrivingLicenceController@destroy')->name('driving_licence.destroy');
    Route::post('driving_licence/store','admin\DrivingLicenceController@store')->name('driving_licence.store');
    Route::post('driving_licence/update', 'admin\DrivingLicenceController@update')->name('driving_licence.update'); 
    Route::post('driving_licence/import','admin\DrivingLicenceController@import')->name('driving_licence.import');
    Route::get('vehicle', 'admin\VehicleController@index')->name('admin.vehicle');
    Route::get('vehicle-list', 'admin\VehicleController@vehicleList')->name('vehicle-list'); 
    Route::post('vehicle/store','admin\VehicleController@store')->name('admin.vehicle.store');
    Route::post('vehicle/update', 'admin\VehicleController@update')->name('admin.vehicle.update'); 
    Route::post('vehicle/destroy','admin\VehicleController@destroy')->name('vehicle-admin.destroy');
    Route::post('vehicle/import','admin\VehicleController@import')->name('admin.vehicle.import');
    Route::get('vehicle/checkvehiclebyid','admin\VehicleController@checkVehicleByPlateId')->name('admin.vehicle.checkvehiclebyid');
    Route::post('vehicle/type-v-chart','admin\VehicleController@makeBarChartTypeV')->name('admin.vehicle.type-v-chart');
    Route::post('vehicle/owner-v-chart','admin\VehicleController@makePieChartOwnerV')->name('admin.vehicle.owner-v-chart');
    Route::post('vehicle/line-v-chart','admin\VehicleController@makePieChartLineV')->name('admin.vehicle.line-v-chart');
    Route::post('vehicle/brand-v-chart','admin\VehicleController@makePolarChartBrandV')->name('admin.vehicle.brand-v-chart');
    Route::post('vehicle/model-v-chart','admin\VehicleController@makePolarChartModelV')->name('admin.vehicle.model-v-chart');
    Route::post('vehicle/add-driver-vehicle','admin\VehicleController@addVehicleDriver')->name('admin.vehicle.add-driver-vehicle');
    Route::get('driver-info/admin1-select-lists', 'admin\Admin1Controller@getAdmin1toSelect2')->name('admin1-select-lists'); 
    Route::get('driver-info/admin2-select-lists', 'admin\Admin2Controller@getAdmin2toSelect2')->name('admin2-select-lists'); 
    Route::get('driver-info/admin3-select-lists', 'admin\Admin3Controller@getAdmin3toSelect2')->name('admin3-select-lists'); 
    Route::post('driver-vehicle-list', 'admin\DriverVehicleController@listDriverVehicle')->name('driver-vehicle-list');
    Route::post('driver-vehicle/destroy','admin\DriverVehicleController@destroy')->name('admin.driver-vehicle.destroy'); 
    Route::get('images/', 'admin\ImageController@index')->name('images.index');
    Route::post('images/store', 'admin\ImageController@store')->name('images.store');
    Route::get('downloads3/{path}', 'admin\ImageController@downloadFile')->name('images.downloadfiles3');
    Route::post('images/get-documents-driver', 'admin\ImageController@getDocumentsDriver')->name('images.get-documents-driver');
    Route::post('images/update', 'admin\ImageController@update')->name('images.update');
});


// Probar plantillas
Route::get('/plantilla', function () {
    return view('mails.mailcontactus');
})->name('plantilla');

Route::post('/saveimg', 'ImageController@saveImgS3')->name('saveimg');


Route::prefix('mail')->group(function () {
    Route::post('contact-us', 'EmailController@sendContactUS')->name('mail.contact-us');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('data-conductores')->group(function () {
    Route::get('/', 'dataConductores\DataConductoresController@index')->name("dataconductores");
    Route::get('/save', 'dataConductores\DataConductoresController@store')->name("storeDataConductores");
    Route::resource('user-information', 'dataConductores\UserInformationController');
    route::post('user-information/validate', 'dataConductores\UserInformationController@validateUserInformation')->name('user-information.validate');
    Route::resource('driving-licence', 'dataConductores\DrivingLicenceController');
    route::post('driving-licence/validate', 'dataConductores\DrivingLicenceController@validateDrivingLicence')->name('driving-licence.validate');
    Route::resource('vehicle', 'dataConductores\VehicleController');
    route::post('vehicle/validate', 'dataConductores\VehicleController@validateVehicle')->name('vehicle.validate');
});


