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

//Frontend
Route::group(['prefix' => '/', 'namespace' => 'Frontend'], function() {
    Route::get('/', function () {
        return view('Frontend.Contents.home');
    })->name('home');
    //Buy
    Route::get('buy-business/process', 'BuyController@process')->name('fe.buy_business_process');
    Route::get('buy-business/qa', 'BuyController@qa')->name('fe.buy_qa');
    Route::get('buy-business/safeguard', 'BuyController@guard')->name('fe.buy_guard');
    Route::get('buy-business', 'BuyController@buy')->name('fe.buy');
    Route::post('buy-business', 'BuyController@buyBusiness')->name('fe.buy-business');

    Route::get('sell-business-process', 'SellController@process')->name('fe.sell_business_process');
    Route::get('sell-business-qa', 'SellController@qa')->name('fe.sell_business_qa');
    Route::get('sell-criteria', 'SellController@criteria')->name('fe.sell_criteria');
    Route::get('sell-valuation', 'SellController@valuation')->name('fe.sell_valuation');
    Route::get('sell-business', 'SellController@sell')->name('fe.sell_business');
    Route::post('sell-business', 'SellController@sellBusiness')->name('fe.post_sell_business');

    Route::get('business', 'BusinessController@business')->name('fe.business');
    Route::post('business', 'BusinessController@searchBusiness')->name('fe.post_business');
    Route::get('business/{id}-{slug}', 'BusinessController@businessDetail')->name('fe.business_detail');

    Route::get('start-up-consultation', 'StartUpController@startup')->name('fe.start_up');

    Route::get('about-us', 'StartUpController@aboutUs')->name('fe.about_us');

    Route::get('contact', 'ContactController@contact')->name('fe.contact');
    Route::post('contact', 'ContactController@addContact')->name('fe.post_contact');


});

//End Frontend

Route::group(['prefix' => 'admin', 'namespace' => 'Auth', 'middleware' => 'web'], function() {
    Route::get('login',  'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'admin/users', 'middleware' => 'auth'], function() {
    Route::get('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@index')->name('user-permission.index');
    Route::post('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@store')->name('user-permission.store');
    Route::get('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@index')->name('roles-permission.index');
    Route::post('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@store')->name('roles-permission.store');
});

Route::resource('admin/roles', '\DangKien\RolePer\Controllers\RoleController');
Route::resource('admin/permissions', '\DangKien\RolePer\Controllers\PermissionController');
Route::resource('admin/permissions-group', '\DangKien\RolePer\Controllers\PermissionGroupController');

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function() {
    
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\controllers\UploadController@upload');

    Route::resource('users', 'UserController');

    Route::get('users/profile', 'Backend\UserController@show')->name('users.profile');
    Route::post('users/profile', 'Backend\UserController@updateSeft')->name('users.updateProfile');

    Route::get('users/change-password', 'Backend\UserController@change')->name('users.change');
    Route::post('users/change-password', 'Backend\UserController@changePassword')->name('users.changePassword');

    Route::resource('languages', 'LanguagesController');

    Route::get('setting', 'SettingController@index')->name('setting.index');

    Route::get('sell-business/process', 'SellController@sellProcess')->name('sell_process.index');
    Route::get('sell-business/sell-criteria', 'SellController@sellCriteria')->name('sell_criteria.index');
    Route::get('sell-business/sell-qa', 'SellController@sellQa')->name('sell_qa.index');
    Route::get('sell-business/sell-valuation', 'SellController@sellValuation')->name('sell_valuation.index');

    Route::post('sell-business/process', 'SellController@saveSell')->name('sell_process.update');
    
    Route::get('purchase-business/process', 'BuyController@buyProcess')->name('buy_process.index');
    Route::get('purchase-business/safe-guard', 'BuyController@gaurd')->name('safe_guard.index');
    Route::get('purchase-business/buy-qa', 'BuyController@buyQa')->name('buy_qa.index');

    Route::post('purchase-business/process', 'BuyController@saveSell')->name('buy_process.update');

    Route::get('start-up-page', 'StartUpController@startUp')->name('start_up.index');

    Route::post('start-up-page', 'StartUpController@saveStartUp')->name('start_up.update');
    

    Route::resource('recruits', 'RecruitController',[ 'export' => ['destroy'] ]);

    Route::resource('slides', 'SlideController',[ 'export' => ['destroy'] ]);
});

Route::group(['prefix' => 'rest/admin', 'middleware' => 'auth'], function() {
    Route::get('users', 'Backend\UserController@getList');
    Route::delete('users/{id}', 'Backend\UserController@destroy');

    Route::get('setting', 'Backend\SettingController@getSetting');
    Route::post('insertSetting', 'Backend\SettingController@insertSetting');

    Route::get('recruit', 'Backend\RecruitController@list');
    Route::delete('recruit/{id}', 'Backend\RecruitController@destroy');

    Route::get('slides', 'Backend\SlideController@list');
    Route::delete('slides/{id}', 'Backend\SlideController@destroy');
});