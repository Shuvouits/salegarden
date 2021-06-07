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
 
 
  Route::get('/hellow', function(){
    return redirect('/');
  });

 


//Route::post('login', 'LoginController@authenticate');

Route::group(['namespace' => 'frontend'], function () {
    Route::get('/hellow', 'RegisterController@hellow');

    Route::get('social/{provider}', 'RegisterController@redirectToProvider');
    Route::get('social/{provider}/callback', 'RegisterController@handleProviderCallback');

    Route::get('/', 'HomeController@home');
    Route::post('/productLoad', 'HomeController@productLoad');
    Route::get('/register', 'RegisterController@userRegister');
    Route::post('/createUser', 'RegisterController@createUser');
    Route::get('/companyRegister', 'RegisterController@companyRegister');
    Route::post('/createCompany', 'RegisterController@createCompany');
    Route::get('/productDetails/{id}', 'ProductController@productDetails');

    Route::get('/search', 'ProductController@search');
    Route::get('/allProduct', 'ProductController@allProduct');
    Route::get('/userProduct', 'ProductController@userProduct');
    Route::get('/companyProduct', 'ProductController@companyProduct');
    Route::get('/brandList', 'ProductController@brandList');
    Route::get('/brand/{id}', 'ProductController@brandProduct');


    Route::get('category/{id}', 'ProductController@categoryList');
    Route::get('subCategory/{id}', 'ProductController@subCategoryList');
    Route::get('/preOrderProduct', 'ProductController@preOrderProduct');

    Route::get('review/{id}', 'ReviewController@getReview');
    Route::post('postReview', 'ReviewController@postReview');
    Route::get('contact', 'ContactController@contact');
    Route::post('contactStore', 'ContactController@contactStore');

    Route::get('/preOrderCategoryProduct/{id}', 'ProductCategoryController@preOrderProduct');
    Route::get('/companyCategoryProduct/{id}', 'ProductCategoryController@companyProduct');
    Route::get('/userCategoryProduct/{id}', 'ProductCategoryController@userProduct');
    Route::get('/allCategoryProduct/{id}', 'ProductCategoryController@allProduct');

    Route::get('/preOrderSubCategoryProduct/{id}', 'ProductCategoryController@preOrderSubProduct');
    Route::get('/companySubCategoryProduct/{id}', 'ProductCategoryController@companySubProduct');
    Route::get('/userSubCategoryProduct/{id}', 'ProductCategoryController@userSubProduct');
    Route::get('/allSubCategoryProduct/{id}', 'ProductCategoryController@allSubProduct');

    Route::get('/preOrderBrandProduct/{id}', 'ProductCategoryController@preOrderBrandProduct');
    Route::get('/companyBrandProduct/{id}', 'ProductCategoryController@companyBrandProduct');
    Route::get('/userBrandProduct/{id}', 'ProductCategoryController@userBrandProduct');
    Route::get('/allBrandProduct/{id}', 'ProductCategoryController@allBrandProduct');

    Route::get('order/{id}', 'OrderController@order');

    Route::get('/checkout', 'OrderController@checkout');
    Route::post('checkoutStore', 'OrderController@checkoutStore');
    Route::post('orderDestroy', 'OrderController@destroy');

    Route::get('orderDetails/{id}', 'OrderController@orderDetails');
    Route::post('orderDetailsStore', 'OrderController@orderDetailsStore');
    Route::get('orderFinal/{id}', 'OrderController@orderFinal');
    Route::get('orderConfirm/{id}', 'OrderController@orderConfirm');
});

Route::group(['namespace' => 'Auth'], function () {

    Route::get('forget/password', 'ForgotPasswordController@showLinkRequestForm')->name('password.forget');

    Route::post('forget/password', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');

    Route::post('password/reset', 'ResetPasswordController@reset')->name('admin.password.reset');
});

Route::group(['namespace' => 'backend'], function () {

   

    Route::get('portal/login', 'LoginController@login');


    Route::post('login', 'LoginController@authenticate');


    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', function () {
            Auth::logout();
            return redirect('portal/login')->with('success', 'Logged out successfully');
        });



        
        
        
        
        Route::post('getSubCategory', 'GeneralController@getSubCategory');
        Route::post('getSecondCategory', 'GeneralController@getSecondCategory');
        Route::post('getSub', 'GeneralController@getSub');

       

        Route::group(['middleware' => 'auth'], function () {

            
            Route::get('portal/dashboard', 'DashboardController@dashboard');
            Route::get('portal/dashboard/admin', 'DashboardController@adminDashboard');
            Route::get('portal/dashboard/user', 'DashboardController@userDashboard');
            Route::get('portal/dashboard/company', 'DashboardController@companyDashboard');

            Route::get('portal/profile', 'ProfileController@showProfileList');
            Route::get('portal/profile/edit', 'ProfileController@editProfileList');
            Route::post('portal/profile/update', 'ProfileController@updateProfileList');
            Route::post('portal/profile/companyUpdate', 'ProfileController@companyUpdate');
            Route::get('portal/profile/passwordEdit', 'ProfileController@editPassword');
            Route::post('portal/profile/passwordUpdate', 'ProfileController@updatePassword');

            Route::get('portal/category/list', 'CategoryController@showList');
            Route::get('portal/category/add', 'CategoryController@add');
            Route::post('portal/category/store', 'CategoryController@store');
            Route::get('portal/category/edit/{id}', 'CategoryController@edit');
            Route::post('portal/category/update', 'CategoryController@update');
            Route::post('portal/category/delete', 'CategoryController@delete');

            Route::get('portal/area/list', 'AreaController@showList');
            Route::get('portal/area/add', 'AreaController@add');
            Route::post('portal/area/store', 'AreaController@store');
            Route::get('portal/area/edit/{id}', 'AreaController@edit');
            Route::post('portal/area/update', 'AreaController@update');
            Route::post('portal/area/delete', 'AreaController@delete');

            Route::get('portal/brand/list', 'BrandController@showList');
            Route::get('portal/brand/add', 'BrandController@add');
            Route::post('portal/brand/store', 'BrandController@store');
            Route::get('portal/brand/edit/{id}', 'BrandController@edit');
            Route::post('portal/brand/update', 'BrandController@update');
            Route::post('portal/brand/delete', 'BrandController@delete');

            Route::get('portal/subCategory/list', 'SubCategoryController@showList');
            Route::get('portal/subCategory/add', 'SubCategoryController@add');
            Route::post('portal/subCategory/store', 'SubCategoryController@store');
            Route::get('portal/subCategory/edit/{id}', 'SubCategoryController@edit');
            Route::post('portal/subCategory/update', 'SubCategoryController@update');
            Route::post('portal/subCategory/delete', 'SubCategoryController@delete');


            Route::get('portal/secondCategory/list', 'SecondCategoryController@showList');
            Route::get('portal/secondCategory/add', 'SecondCategoryController@add');
            Route::post('portal/secondCategory/store', 'SecondCategoryController@store');
            Route::get('portal/secondCategory/edit/{id}', 'SecondCategoryController@edit');
            Route::post('portal/secondCategory/update', 'SecondCategoryController@update');
            Route::post('portal/secondCategory/delete', 'SecondCategoryController@delete');

            Route::get('portal/admin/list', 'AdminController@showList');
            Route::get('portal/admin/add', 'AdminController@add');
            Route::post('portal/admin/store', 'AdminController@store');
            Route::get('portal/user/activate/{id}', 'AdminController@activate');
            Route::post('portal/user/inActivate', 'AdminController@inActivate');
            Route::get('portal/admin/reset/{id}', 'AdminController@reset');
            Route::post('portal/admin/resetstore', 'AdminController@resetstore');

            Route::get('portal/product/companyAdd', 'CompanyProductController@add');
            Route::post('portal/product/companyStore', 'CompanyProductController@store');
            Route::get('portal/product/companyedit/{id}', 'CompanyProductController@edit');
            Route::post('portal/product/companyUpdate', 'CompanyProductController@update');
            Route::get('portal/product/companyList', 'CompanyProductController@showList');
            Route::get('portal/product/image/{id}', 'CompanyProductController@companyImage');
            Route::get('portal/product/addImage/{id}', 'CompanyProductController@addImage');
            Route::get('portal/product/editImage/{id}', 'CompanyProductController@editImage');
            Route::post('portal/product/updateImage', 'CompanyProductController@updateImage');
            Route::post('portal/product/storeImage', 'CompanyProductController@storeImage');
            Route::post('portal/product/deleteImage', 'CompanyProductController@deleteImage');

            Route::get('portal/product/companyPreOrderList', 'PreOrderProductController@showList');
            Route::get('portal/product/preOrderAdd', 'PreOrderProductController@add');
            Route::post('portal/product/companyPreOrderStore', 'PreOrderProductController@store');
            Route::get('portal/product/companyPreOrderedit/{id}', 'PreOrderProductController@edit');
            Route::post('portal/product/companyPreOrderUpdate', 'PreOrderProductController@update');

            Route::get('portal/product/userAdd', 'UserProductController@add');
            Route::post('portal/product/userStore', 'UserProductController@store');
            Route::get('portal/product/useredit/{id}', 'UserProductController@edit');
            Route::post('portal/product/userUpdate', 'UserProductController@update');
            Route::get('portal/product/userList', 'UserProductController@showList');

            Route::get('portal/product/activeList', 'AdminProductController@showActiveList');
            Route::get('portal/product/inactiveList', 'AdminProductController@showInactiveList');
            Route::post('portal/product/activate', 'AdminProductController@activate');
            Route::post('portal/product/inactivate', 'AdminProductController@inactivate');
            Route::get('portal/product/adminImage/{id}', 'AdminProductController@imageList');
            Route::post('portal/product/normal', 'AdminProductController@normal');
            Route::post('portal/product/featured', 'AdminProductController@featured');
            Route::post('portal/product/delete', 'AdminProductController@delete');

            Route::get('portal/product/review/{id}', 'ReviewController@getReview');
            Route::post('portal/review/activate', 'ReviewController@activate');
            Route::post('portal/review/inactivate', 'ReviewController@inactivate');

            Route::get('portal/contactList', 'ContactController@showList');
            Route::post('portal/contact/delete', 'ContactController@delete');

            Route::get('portal/order/list', 'OrderController@showList');
        });
    });
});
