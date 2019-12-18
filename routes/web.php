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
    Route::get('/', 'admin\AdminController@index')->name("admin");
    Route::get('users', 'admin\UserController@index')->name('admin.users');
    Route::post('users/update', 'admin\UserController@update')->name('users.update');
    Route::get('users-list', 'admin\UserController@usersList')->name('users-list'); 
    Route::post('/register-user','admin\UserController@storeUserAdmin')->name('register-user');
    Route::post('/user-admin/destroy','admin\UserController@destroy')->name('user-admin.destroy');
    Route::get('driver_info', 'admin\DriverInformationController@index')->name('admin.driver_info');
    Route::post('driver-info/update', 'admin\DriverInformationController@update')->name('driver-info.update'); 
    Route::get('driver-info-list', 'admin\DriverInformationController@driveInformationList')->name('driver-info-list'); 
    Route::post('driver-info/store','admin\DriverInformationController@store')->name('driver-info.store');
    Route::post('driver-info/destroy','admin\DriverInformationController@destroy')->name('driver-info.destroy');
    Route::post('driver-info/import','admin\DriverInformationController@import')->name('driver-info.import');
    Route::get('driver-info/drivers-select-lists', 'admin\DriverInformationController@getDriveInformationtoSelect2')->name('drivers-select-lists'); 
    Route::get('driver-info/name-driver', 'admin\DriverInformationController@getNameDriver')->name('drivers-get-name'); 
    Route::get('company-search-list', 'admin\CompanyController@getCompanies')->name('company-search-list'); 
    Route::get('company-select-list', 'admin\CompanyController@getCompaniestoSelect2')->name('company-select-list'); 
    Route::get('driving_licence', 'admin\DrivingLicenceController@index')->name('admin.driving_licence');
    Route::get('driving-licence-list', 'admin\DrivingLicenceController@drivingLicenceList')->name('driving-licence-list'); 
    Route::post('driving_licence/destroy','admin\DrivingLicenceController@destroy')->name('driving_licence.destroy');
    Route::post('driving_licence/store','admin\DrivingLicenceController@store')->name('driving_licence.store');
    Route::get('vehicle', 'admin\vehicleController@index')->name('admin.vehicle');
    Route::get('vehicle-list', 'admin\vehicleController@vehicleList')->name('vehicle-list'); 
    Route::post('vehicle/store','admin\vehicleController@store')->name('admin.vehicle.store');
    Route::post('vehicle/destroy','admin\vehicleController@destroy')->name('vehicle-admin.destroy');
    Route::get('driver-info/admin1-select-lists', 'admin\Admin1Controller@getAdmin1toSelect2')->name('admin1-select-lists'); 
    Route::get('driver-info/admin2-select-lists', 'admin\Admin2Controller@getAdmin2toSelect2')->name('admin2-select-lists'); 
    Route::get('driver-info/admin3-select-lists', 'admin\Admin3Controller@getAdmin3toSelect2')->name('admin3-select-lists'); 
});

Route::post('/saveimg', 'ImageController@saveImgS3')->name('saveimg');

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


