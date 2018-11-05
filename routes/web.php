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
    |       discount type        |
    |---------------------------*/
    Route::get('settings/discount_type','settings\CustomerDiscountTypeController@index')->name('allCustomersDiscount');
    Route::get('settings/discount_type/datatable','settings\CustomerDiscountTypeController@datatable')->name('CustomerDiscountTypeDataTable');
    Route::post('settings/discount_type/save','settings\CustomerDiscountTypeController@store')->name('saveCustomerDiscountType');
    Route::get('settings/discount_type/edit/{id}','settings\CustomerDiscountTypeController@edit')->name('editCustomerDiscountType');
    Route::post('settings/discount_type/update/{id}','settings\CustomerDiscountTypeController@update')->name('updateCustomerDiscountType');
    /*---------------------------|
    |       customer type        |
    |---------------------------*/
    Route::get('settings/customer_type','settings\CustomerTypeController@index')->name('allCustomersType');
    Route::get('settings/customer_type/datatable','settings\CustomerTypeController@datatable')->name('CustomerTypeDataTable');
    Route::post('settings/customer_type/save','settings\CustomerTypeController@store')->name('saveCustomerType');
    Route::get('settings/customer_type/edit/{id}','settings\CustomerTypeController@edit')->name('editCustomerType');
    Route::post('settings/customer_type/update/{id}','settings\CustomerTypeController@update')->name('updateCustomerType');
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
    |   choose invoice settings |
    |--------------------------*/
    Route::get('settings/choose_invoice', 'settings\SettingsController@choose_invoice')->name('chooseInvoice');
    Route::get('settings/set_invoice/{template}', 'settings\SettingsController@set_invoice')->name('setInvoice');
    Route::get('settings/invoice/{template}', 'settings\SettingsController@buy_invoice')->name('buyInvoice');

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

    /*---------------------------|
    |       Product Settings     |
    |---------------------------*/

    /*---------------------------|
    |  product category settings |
    |---------------------------*/
    Route::get('product/category', 'product\ProductCatSettingsController@index')->name('productCategory');
    Route::post('product/category', 'product\ProductCatSettingsController@store')->name('saveProductCategory');
    Route::get('product/category/datatable', 'product\ProductCatSettingsController@datatable')->name('productCategoryDataTable');
    Route::get('product/category/edit/{id}', 'product\ProductCatSettingsController@edit')->name('editProductCategory');
    Route::post('product/category/edit/{id}', 'product\ProductCatSettingsController@update')->name('updateProductCategory');
    Route::get('product/category/deactivate/{id}', 'product\ProductCatSettingsController@deactivate')->name('deactivateProductCategory');
    Route::get('product/category/reactive/{id}', 'product\ProductCatSettingsController@reactive')->name('reactiveProductCategory');
    /*---------------------------|
    |       product settings     |
    |---------------------------*/
    Route::get('products', 'product\ProductController@index')->name('allProducts');
    Route::post('product/save', 'product\ProductController@store')->name('saveProduct');
    Route::get('product/edit/{id}', 'product\ProductController@edit')->name('editProduct');
    Route::post('product/edit/{id}', 'product\ProductController@update')->name('updateProduct');
    Route::get('product/deactivate/{id}', 'product\ProductController@deactivate')->name('deactivateProduct');
    Route::get('product/reactive/{id}', 'product\ProductController@reactive')->name('reactiveProduct');
    #dataTable
    Route::get('product/datatable', 'product\ProductController@datatable')->name('productsDataTable');
    #print
    Route::get('product/print_product_info','product\ProductController@print_product_info')->name('print_product_info');
    #pdf
    Route::get('product/download/pdf','product\ProductController@make_pdf')->name('make_pdf');

    /*---------------------------|
    |          customers         |
    |---------------------------*/
    Route::get('customers', 'customers\CustomersController@index')->name('customers');
    Route::get('customer/new', 'customers\CustomersController@create')->name('createCustomer');
    Route::post('customer/save', 'customers\CustomersController@store')->name('saveCustomer');
    Route::get('customers/datatable', 'customers\CustomersController@datatable')->name('customersDataTable');
    Route::get('customer/edit/{id}', 'customers\CustomersController@edit')->name('editCustomerInfo');
    Route::post('customer/update/{id}', 'customers\CustomersController@update')->name('updateCustomer');
    #print all customer as id
    Route::get('customers/print/ids', 'customers\CustomersController@ids')->name('printCustomersIDs');
    #print all info
    Route::get('customers/print/info', 'customers\CustomersController@info')->name('printCustomersInfo');
    Route::get('customer/single_id/{id}', 'customers\CustomersController@single_id')->name('single_idCustomersInfo');


    /*--------------------------|
    |           Sells           |
    |--------------------------*/
    #basic sell for all
    Route::get('sales/invoices', 'sales\SalesController@index')->name('oldInvoices');
    Route::get('sales/datatable/morning', 'sales\SalesController@datatable_morning')->name('sales.datatable.morning');
    Route::get('sales/datatable/evening', 'sales\SalesController@datatable_evening')->name('sales.datatable.evening');
    Route::get('sale/new', 'sales\SalesController@create')->name('newSales');

    Route::get('sale/view/{inv}', 'sales\SalesController@show')->name('invoice.view');
    Route::get('sale/edit/{inv}', 'sales\SalesController@edit')->name('invoice.edit');
    Route::post('sale/update/{inv}', 'sales\SalesController@update')->name('invoice.update');
    Route::get('sale/print/{inv}', 'sales\SalesController@print_duplicate')->name('invoice.print');

    Route::get('sale/get_customer', 'sales\SalesController@get_customer')->name('sales.get_customer');
    Route::post('sale/get_customer_info', 'sales\SalesController@get_customer_info')->name('sales.get_customer_info');
    Route::post('sale/get_customer_discount_info', 'sales\SalesController@get_customer_discount_info')->name('sales.get_customer_discount_info');
    Route::post('sale/add_customer_info', 'sales\SalesController@add_customer_info')->name('sales.add_customer_info');
    #changable
    Route::post('sale/get_product','sales\SalesController@get_product')->name('sales.get_product');
    Route::post('sale/get_price','sales\SalesController@get_price')->name('sales.get_price');
    Route::post('sale/saveInvoice','sales\SalesController@store')->name('sales.saveInvoice');

    /*--------------------------|
    |     Due payments          |
    |--------------------------*/
    Route::get('due_payment/all_invoices','duePayment\DuePaymentController@index')->name('due_payment.all_due_invoices');
    Route::get('due_payment/datatable','duePayment\DuePaymentController@datatable')->name('due_payment.datatable');
    Route::post('due_payment/get_customer_due_info','duePayment\DuePaymentController@get_customer_due_info')->name('due_payment.get_customer_due_info');

    Route::get('due_payment/receive','duePayment\DuePaymentController@create')->name('due_payment.receive');
    Route::post('due_payment/save','duePayment\DuePaymentController@store')->name('due_payment.save');

    Route::get('due_payment/show/{id}','duePayment\DuePaymentController@show')->name('due_payment.show');
    Route::get('due_payment/print/{id}','duePayment\DuePaymentController@print')->name('due_payment.print');
    Route::get('due_payment/edit/{id}','duePayment\DuePaymentController@edit')->name('due_payment.edit');
    Route::post('due_payment/update/{id}','duePayment\DuePaymentController@update')->name('due_payment.update');

    Route::post('due_payment/get_statement','duePayment\DuePaymentController@get_statement')->name('due_payment.get_statement');
    Route::post('due_payment/print_statement','duePayment\DuePaymentController@print_statement')->name('due_payment.print_statement');
    /*--------------------------|
    |       production          |
    |--------------------------*/
    Route::get('production/history','production\ProductionController@index')->name('production.history');
    Route::get('production/new','production\ProductionController@create')->name('production.new');
    Route::post('production/store','production\ProductionController@store')->name('production.save');
    Route::get('production/datatable','production\ProductionController@datatable')->name('production.datatable');

    Route::get('production/show/{pro}','production\ProductionController@show')->name('production.show');
    Route::get('production/edit/{pro}','production\ProductionController@edit')->name('production.edit');
    Route::post('production/update/{pro}','production\ProductionController@update')->name('production.update');

    /*--------------------------|
    |       destroy             |
    |--------------------------*/
    Route::get('storage/history','storage\StorageController@index')->name('storage.history');
    Route::get('storage/new','storage\StorageController@create')->name('storage.new');
    Route::post('storage/store','storage\StorageController@store')->name('storage.save');
    Route::get('storage/datatable','storage\StorageController@datatable')->name('storage.datatable');
    Route::get('storage/show/{sto}','storage\StorageController@show')->name('storage.show');
    Route::get('storage/edit/{sto}','storage\StorageController@edit')->name('storage.edit');
    Route::post('storage/update/{sto}','storage\StorageController@update')->name('storage.update');

    /*--------------------------|
    |       return              |
    |--------------------------*/
    Route::get('return/history','sellreturn\ReturnController@index')->name('return.history');
    Route::get('return/new','sellreturn\ReturnController@create')->name('return.new');
    Route::get('return/datatable','sellreturn\ReturnController@datatable')->name('return.datatable');
    Route::post('return/store','sellreturn\ReturnController@store')->name('return.save');

    Route::get('return/show/{sto}','sellreturn\ReturnController@show')->name('return.show');
    Route::get('return/edit/{sto}','sellreturn\ReturnController@edit')->name('return.edit');
    Route::post('return/update/{sto}','sellreturn\ReturnController@update')->name('return.update');

    /*--------------------------|
    |       Reports             |
    |--------------------------*/

    /*--------------------------|
    |       Statement           |
    |--------------------------*/
    Route::get('reports/statement/customer','reports\ReportsController@index')->name('reports.statement.customer');
    Route::post('reports/statement/customer/generate_statement','reports\ReportsController@generate_customer_statement')->name('reports.statement.customer.generate_statement');
    Route::post('reports/statement/customer/print_statement','reports\ReportsController@print_customer_statement')->name('reports.statement.customer.print_statement');

    /*--------------------------|
    |       Due Customer List   |
    |--------------------------*/
    Route::get('reports/deu_customer_list/show','reports\ReportsController@show_deu_customer_list')->name('reports.deu_customer_list.show');
    Route::get('reports/deu_customer_list/datatable','reports\ReportsController@show_deu_customer_list_datatable')->name('reports.deu_customer_list.datatable');
    Route::get('reports/deu_customer_list/print','reports\ReportsController@print_deu_customer_list')->name('reports.deu_customer_list.pring');

    /*--------------------------|
    |   production Report       |
    |--------------------------*/
    Route::get('reports/production_report/show','reports\ReportsController@production_report')->name('reports.production_report.show');
    Route::post('reports/production_report/generate_report','reports\ReportsController@generate_production_report')->name('reports.production_report.generate_report');
    Route::post('reports/production_report/print','reports\ReportsController@print_production_report')->name('reports.production_report.print');

    /*--------------------------|
    |       Sells Report        |
    |--------------------------*/
    Route::get('reports/sales_report/show','reports\ReportsController@sales_report')->name('reports.sells_report.show');
    Route::post('reports/sales_report/generate_report','reports\ReportsController@generate_sales_report')->name('reports.sells_report.generate_report');
    Route::post('reports/sales_report/print','reports\ReportsController@print_sales_report')->name('reports.sales_report.print');

    /*--------------------------|
    |       Sells Report        |
    |--------------------------*/
    Route::get('reports/statement/income','reports\ReportsController@income_statement')->name('reports.statement.income');
    Route::post('reports/statement/generate_income_statement','reports\ReportsController@generate_income_statement')->name('reports.statement.income.generate');
    Route::post('reports/statement/print_income_statement','reports\ReportsController@print_income_statement')->name('reports.statement.income.print');

    /*---------------------------|
    |   vendor management        |
    |---------------------------*/
    Route::get('vendor_management/vendor_list','vendorManagement\VendorManagementController@index')->name('vendor.list');
    Route::get('vendor_management/new','vendorManagement\VendorManagementController@create')->name('vendor.new');
    Route::post('vendor_management/save_vendor','vendorManagement\VendorManagementController@store')->name('vendor.save');
    Route::get('vendor_management/datatable','vendorManagement\VendorManagementController@datatable')->name('vendor.datatable');
    Route::get('vendor_management/edit/{id}','vendorManagement\VendorManagementController@edit')->name('vendor.edit');
    Route::get('vendor_management/print_list','vendorManagement\VendorManagementController@print_list')->name('vendor.print_list');
    Route::post('vendor_management/update/{id}','vendorManagement\VendorManagementController@update')->name('vendor.update');

    Route::get('vendor_management/select2/search', 'vendorManagement\VendorManagementController@search')->name('vendor.select2.search');


    /*---------------------------|
    |     Cost management        |
    |---------------------------*/

    /*---------------------------|
    |     Cost Category          |
    |---------------------------*/
    Route::get('cost_management/category','costmanagement\CostCategoryController@index')->name('cost_management.category');
    Route::post('cost_management/category/save','costmanagement\CostCategoryController@store')->name('cost_management.category.save');
    Route::get('cost_management/category/datatable','costmanagement\CostCategoryController@datatable')->name('cost_management.category.datatable');

    Route::get('cost_management/category/edit/{id}','costmanagement\CostCategoryController@edit')->name('cost_management.category.edit');
    Route::post('cost_management/category/update/{id}','costmanagement\CostCategoryController@update')->name('cost_management.category.update');
    Route::get('cost_management/category/deactivate/{id}','costmanagement\CostCategoryController@deactivate')->name('cost_management.category.deactivate');
    Route::get('cost_management/category/reactive/{id}','costmanagement\CostCategoryController@reactive')->name('cost_management.category.reactive');

    /*---------------------------|
    |     Cost items             |
    |---------------------------*/
    Route::get('cost_management/items','costmanagement\CostItemController@index')->name('cost_management.items');
    Route::post('cost_management/items/save','costmanagement\CostItemController@store')->name('cost_management.items.save');
    Route::get('cost_management/items/datatable','costmanagement\CostItemController@datatable')->name('cost_management.items.datatable');

    Route::get('cost_management/items/edit/{id}','costmanagement\CostItemController@edit')->name('cost_management.items.edit');
    Route::post('cost_management/items/update/{id}','costmanagement\CostItemController@update')->name('cost_management.items.update');
    Route::get('cost_management/items/deactivate/{id}','costmanagement\CostItemController@deactivate')->name('cost_management.items.deactivate');
    Route::get('cost_management/items/reactive/{id}','costmanagement\CostItemController@reactive')->name('cost_management.items.reactive');


    /*---------------------------|
    |     voucher                |
    |---------------------------*/
    Route::get('voucher/items','voucher\VoucherController@index')->name('voucher.items');
    Route::get('voucher/new','voucher\VoucherController@create')->name('voucher.new');
    Route::post('voucher/get_items','voucher\VoucherController@get_items')->name('voucher.get_items');

    Route::post('voucher/save','voucher\VoucherController@store')->name('voucher.save');
    Route::get('voucher/datatable','voucher\VoucherController@datatable')->name('voucher.datatable');
    Route::get('voucher/edit/{voucher}','voucher\VoucherController@edit')->name('voucher.edit');

    Route::post('voucher/update/{voucher_no}','voucher\VoucherController@update')->name('voucher.update');
    Route::get('voucher/show/{voucher_no}','voucher\VoucherController@show')->name('voucher.show');


});
