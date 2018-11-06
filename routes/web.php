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

//Route::get('check_jquery_login','settings\Notifications@check_jquery_login')->name('checkJqueryLogin');
Auth::routes();
/*--------------------------|
|       activate User       |
|--------------------------*/
Route::get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
Route::group(['middleware'=>'auth'],function (){

    Route::get('/','DashboardController@index')->name('dashboard');
    Route::get('profile','ProfileController@index')->name('showProfile');
    Route::post('profile','ProfileController@update')->name('updateProfile');

    /**
     * settings
     */
    /*--------------------------|
    |       notifications       |
    |--------------------------*/
    Route::get('notifications','settings\Notifications@index')->name('Notifications');
    Route::get('notification_see','settings\Notifications@notification_see')->name('notification_see');
    //Route::get('get_total_new_notification','settings\Notifications@get_total_new_notification')->name('getTotalNewNotification');
    /*--------------------------|
    |       basic settings      |
    |--------------------------*/
    Route::get('settings/general','settings\SettingsController@index')->name('generalSettings');
    Route::post('settings/general','settings\SettingsController@store')->name('savegeneralSettings');
    /*--------------------------|
    |       branch setup        |
    |--------------------------*/
    Route::get('settings/branch','settings\BranchController@index')->name('allBranch');
    Route::get('settings/branch/datatable','settings\BranchController@datatable')->name('branchDataTable');
    Route::get('settings/branch/new','settings\BranchController@create')->name('newBranch');
    Route::post('settings/branch/new','settings\BranchController@store')->name('storeBranch');
    Route::get('settings/branch/edit/{id}','settings\BranchController@edit')->name('editBranch');
    Route::post('settings/branch/edit/{id}','settings\BranchController@update')->name('updateBranch');
    Route::get('settings/branch/shut_down/{id}','settings\BranchController@shut_down')->name('shutDownBranch');
    Route::get('settings/branch/reopen/{id}','settings\BranchController@reopen')->name('reopenBranch');

    /*---------------------------|
     *      employee part start  |
     * -------------------------*/
    #   employee part
    Route::get('settings/employee/all', 'employees\EmployeeController@index')->name('employee.all');
    Route::get('settings/employee/datatable', 'employees\EmployeeController@datatable')->name('employee.all.datatable');
    Route::get('settings/employee/new', 'employees\EmployeeController@create')->name('employee.new');
    Route::post('settings/employee/save', 'employees\EmployeeController@store')->name('employee.save');
    Route::post('settings/employee/save_designation', 'employees\EmployeeController@save_designation')->name('employee.save_designation');

    Route::get('settings/employee/name/search', 'employees\EmployeeController@search')->name('employee.name.search');

    Route::get('settings/employee/edit/{id}', 'employees\EmployeeController@edit')->name('employee.edit');
    Route::post('settings/employee/update/{id}', 'employees\EmployeeController@update')->name('employee.update');

    Route::get('settings/employee/print/info', 'employees\EmployeeController@print_info')->name('employee.print_info');
    Route::get('settings/employee/print/single/{id}', 'employees\EmployeeController@print_single')->name('employee.print_single');
    #   employee designation part
    Route::get('settings/employee/designations', 'employees\EmployeeDesignationController@index')->name('employee.designations');
    Route::get('settings/employee/search', 'employees\EmployeeDesignationController@search')->name('employee.search');
    Route::post('settings/employee/designations/save', 'employees\EmployeeDesignationController@store')->name('employee.saveDesignations');
    Route::get('settings/employee/designations/datatable', 'employees\EmployeeDesignationController@datatable')->name('employee.datatable');
    Route::get('settings/employee/designations/edit/{id}', 'employees\EmployeeDesignationController@edit')->name('employee.editDesignations');
    Route::post('settings/employee/designations/update/{id}', 'employees\EmployeeDesignationController@update')->name('employee.updateDesignations');

    /*--------------------------|
    |       users settings      |
    |--------------------------*/
    Route::get('settings/users','settings\UserController@index')->name('allUsersInfo');
    Route::get('settings/users/datatable','settings\UserController@datatable')->name('allUsersInfoDataTable');
    Route::get('settings/user/new','settings\UserController@create')->name('signUpForm');
    Route::post('settings/user/new','settings\UserController@store')->name('storeUserInfo');
    Route::get('settings/user/details/{id}','settings\UserController@show')->name('showUserInfo');
    Route::get('settings/user/block/{id}','settings\UserController@block')->name('blockUser');
    Route::get('settings/user/unblock/{id}','settings\UserController@unblock')->name('unblockUser');
    Route::get('settings/user/delete/{id}','settings\UserController@destroy')->name('deleteUser');
    Route::post('settings/user/resetUserPassword/{id}','settings\UserController@resetUserPassword')->name('resetUserPassword');
    /*--------------------------|
    |       buy settings        |
    |--------------------------*/
    Route::get('settings/buysettings/category','settings\BuySettingsController@index')->name('buysettings.category.all');
    Route::get('settings/buysettings/category/datatable','settings\BuySettingsController@datatable')->name('buysettings.category.datatable');

    Route::post('settings/buysettings/category/save','settings\BuySettingsController@store')->name('buysettings.category.save');
    Route::post('settings/buysettings/category/update/{id}','settings\BuySettingsController@update')->name('buysettings.category.update');

    Route::get('settings/buysettings/category/edit/{id}','settings\BuySettingsController@edit')->name('buysettings.category.edit');
    Route::get('settings/buysettings/category/deactivate/{id}','settings\BuySettingsController@deactivate')->name('buysettings.category.deactivate');
    Route::get('settings/buysettings/category/reactive/{id}','settings\BuySettingsController@reactive')->name('buysettings.category.reactive');

    Route::get('settings/buysettings/buyProducts','settings\BuySettingsController@buyProducts')->name('buysettings.buyProducts.all');
    Route::get('settings/buysettings/buyProducts/buyProductsDataTable','settings\BuySettingsController@buyProductsDataTable')->name('buysettings.buyProducts.buyProductsDataTable');

    Route::post('settings/buysettings/buyProducts/save','settings\BuySettingsController@saveBuyProducts')->name('buysettings.buyProducts.save');
    Route::post('settings/buysettings/buyProducts/update/{id}','settings\BuySettingsController@updateBuyProducts')->name('buysettings.buyProducts.update');

    Route::get('settings/buysettings/buyProducts/edit/{id}','settings\BuySettingsController@buyProductsEdit')->name('buysettings.buyProducts.edit');
    Route::get('settings/buysettings/buyProducts/deactivate/{id}','settings\BuySettingsController@productDeactivate')->name('buysettings.buyProducts.deactivate');
    Route::get('settings/buysettings/buyProducts/reactive/{id}','settings\BuySettingsController@productReactive')->name('buysettings.buyProducts.reactive');


    /*--------------------------|
    |       sell settings       |
    |--------------------------*/
    Route::get('settings/sellSettings/all','settings\SellSettingsController@index')->name('sellsProduct.all');
    Route::get('settings/sellSettings/datatable','settings\SellSettingsController@datatable')->name('sellsProduct.datatable');

    Route::post('settings/sellSettings/save','settings\SellSettingsController@store')->name('sellsProduct.save');
    Route::post('settings/sellSettings/update/{id}','settings\SellSettingsController@update')->name('sellsProduct.update');

    Route::get('settings/sellSettings/edit/{id}','settings\SellSettingsController@edit')->name('sellsProduct.edit');
    Route::get('settings/sellSettings/deactivate/{id}','settings\SellSettingsController@deactivate')->name('sellsProduct.deactivate');
    Route::get('settings/sellSettings/reactive/{id}','settings\SellSettingsController@reactive')->name('sellsProduct.reactive');
});
