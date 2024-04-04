<?php

use App\User;

Route::get('/dashboard', function () {
	
    $user = User::count();
 
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    return view('company.dashboard', compact('user'));
})->name('dashboard');

Route::get('/home', function(){ return redirect('company/dashboard'); });

Route::get('profile', 'Company\ProfileController@index');
Route::post('profile/update', 'Company\ProfileController@update');
Route::get('change-password', 'Company\ProfileController@changePasswordView');
Route::post('change-password', 'Company\ProfileController@changePassword');

Route::resource('users', 'Company\UsersController');
Route::get('get-users','Company\UsersController@getUsers');
Route::get('users/get-logs/{user_id}','Company\UsersController@getUserLogs');
Route::get('get-user-logs/{user_id}','Company\UsersController@getUserAjaxLogs');
Route::resource('stores', 'Company\StoreController');
Route::get('get-stores', 'Company\StoreController@getStores');
Route::resource('categories', 'Company\CategoriesController');   
Route::get('get-categories', 'Company\CategoriesController@getCategories');
Route::get('get-store-categories/{store_id}','Company\CategoriesController@getStoreCategories');
Route::resource('suppliers', 'Company\SuppliersController');
Route::get('get-suppliers', 'Company\SuppliersController@getSuppliers');
Route::resource('currencies', 'Company\CurrencyController');
Route::get('get-currencies', 'Company\CurrencyController@getCurrencies');
Route::resource('tax-rates', 'Company\TaxRatesController');
Route::get('get-tax-rates', 'Company\TaxRatesController@getTaxRates');
Route::resource('shipping-options', 'Company\ShippingOptionController');
Route::get('get-shipping-options', 'Company\ShippingOptionController@getShippingOptions');

Route::resource('products', 'Company\ProductsController');
Route::patch('products/update-store/{product_id}', 'Company\ProductsController@updateStore');
Route::patch('products/update-combo-products/{product_id}', 'Company\ProductsController@updateComboProducts');
Route::get('get-products', 'Company\ProductsController@getProducts');
Route::delete('products/remove-variant/{variant_id}','Company\ProductsController@removeVariant');
Route::delete('products/remove-combo/{combo_id}','Company\ProductsController@removeCombo');
Route::post('products/store-image','Company\ProductsController@storeImage');
Route::get('products/delete-image/{id}','Company\ProductsController@deleteImage');
Route::post('products/set-default-image','Company\ProductsController@setDefaultImage');
Route::get('products/get-store-categories/{store_id}','Company\ProductsController@getStoreCategories');
Route::get('get-all-store-categories/{product_id?}','Company\ProductsController@getAllStoreCategories');
Route::post('products/create-product-attribute','Company\ProductsController@createProductAttribute');
Route::get('products/get-product-attributes/{product_id}','Company\ProductsController@getProductAttributes');
Route::delete('products/remove-product-attribute/{id}','Company\ProductsController@removeProductAttribute');
Route::post('products/create-product-variant','Company\ProductsController@createProductVariant');
Route::get('products/get-product-variants/{product_id}','Company\ProductsController@getProductVariants');
Route::post('products/set-product-as-default','Company\ProductsController@setProductAsDefault');
Route::get('products/get-product-modifiers/{product_id}','Company\ProductsController@getProductModifiers');
Route::post('products/set-product-modifier','Company\ProductsController@setProductModifier');
Route::get('products/edit/{product_id}','Company\ProductsController@editVariant');
Route::patch('products/update-variant-product/{product_id}','Company\ProductsController@updateVariantProduct');
Route::get('get-combo-products','Company\ProductsController@getComboProducts');
Route::get('get-product-stocks','Company\ProductsController@productStocks');
Route::get('product-stocks/{product_id}','Company\ProductsController@productStocks');
Route::get('get-product-stocks/{product_id}','Company\ProductsController@getProductStocks');

Route::resource('manage-stocks', 'Company\StockController');
Route::get('get-stocks', 'Company\StockController@getStocks');
Route::get('get-store-products/{store_id}', 'Company\StockController@getStoreProducts');

Route::resource('variants', 'Company\VariantController');
Route::get('get-variants', 'Company\VariantController@getVariants');
Route::resource('modifiers', 'Company\ModifierController');
Route::get('get-modifiers', 'Company\ModifierController@getModifiers');
Route::get('modifiers/remove-option/{option_id}', 'Company\ModifierController@removeModifierOption');
Route::resource('customers', 'Company\CustomerController');
Route::get('get-customers', 'Company\CustomerController@getCustomers');
Route::resource('customer-groups', 'Company\CustomerGroupController');
Route::get('get-customer-groups', 'Company\CustomerGroupController@getCustomerGroups');

Route::get('sales', 'Company\OrderController@index');
Route::get('get-sales', 'Company\OrderController@getOrders');
Route::get('get-sale/{order_id}', 'Company\OrderController@edit');
Route::get('invoice/{id}', 'Company\OrderController@orderInvoice');

//Reporsts
Route::get('reports/retail-report', 'Company\ReportController@index');
Route::post('reports/retail-dashboard', 'Company\ReportController@getRetailsDashboard');
Route::get('reports/stores-stock/{store_id?}', 'Company\ReportController@getStoreStocksChart');
Route::get('reports/sales-report', 'Company\ReportController@salesReport');
Route::get('reports/get-sales-report', 'Company\ReportController@getSalesReport');
Route::get('reports/products-report', 'Company\ReportController@productsReport');
Route::get('reports/get-products-report', 'Company\ReportController@getProductsReport');
Route::get('reports/customers-report', 'Company\ReportController@customersReport');
Route::get('reports/get-customers-report', 'Company\ReportController@getCustomersReport');
Route::get('reports/staff-report', 'Company\ReportController@staffReport');
Route::get('reports/get-staff-report', 'Company\ReportController@getStaffReport');


Route::resource('roles', 'Company\RoleController');
Route::get('get-roles', 'Company\RoleController@getRoles');
Route::get('roles/permissions/{role_id}', 'Company\RoleController@getRolePermissions');
Route::put('roles/permissions/{role_id}', 'Company\RoleController@updateRolePermission');
Route::resource('permissions', 'Company\PermissionController');
Route::get('get-permissions', 'Company\PermissionController@getPermissions');

Route::get('settings', 'Company\SettingsController@index');
Route::post('settings/update', 'Company\SettingsController@update');