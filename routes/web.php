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
//Auth::routes();
// Route for cron 
Route::get('email', 'CronController@newMarketingEmail');
//Routes for merchants and seller without prefix merchants/seller when not logged in starts here

Route::group(['namespace' => 'frontend','middleware' => ['noAuth:users']],function(){
	Route::get('', 'LoginController@index');
	Route::get('login', 'LoginController@index');
	Route::post('login','LoginController@authenticate');
	Route::match(['GET','POST'],'register','RegisterController@index');
});

//Routes for merchants and seller without prefix merchants/seller when not logged in ends here

//Routes for merchants and sellers without prefix merchants/sellers when logged in starts here

Route::group(['namespace'=>'frontend','middleware' => ['guest:users']],function(){	
	Route::get('dashboard','LoginController@dashboard');
});

//Routes for merchants and sellers without prefix merchans/sellers when logged in ends here


//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'merchants','namespace' => 'merchants'],function(){
	Route::get('/','DashboardController@index');

});

//Routes for seller with prefix seller when not logged in starts here
Route::group(['prefix'=>'seller','namespace' => 'sellers','middleware' => ['noAuth:users']],function(){
	Route::get('','DashboardController@login');
	Route::match(['GET','POST'],'login','DashboardController@login');
	
});

//Routes for seller with prefix seller when not logged in ends here

//Routes for seller with prefix seller when logged in starts here

Route::group(['prefix' => 'seller','namespace' => 'sellers','middleware'=>['guest:users']],function(){
	//Dashboard routes after login
	Route::get('','DashboardController@index');
	Route::get('dashboard','DashboardController@index');
	Route::post('logout','DashboardController@logout');
	//Products routes
	Route::get('products','ProductController@index');
	Route::match(['GET','POST'],'add-product-type','ProductController@getProductType');
	Route::match(['GET','POST'],'add-product','ProductController@addProduct');
	Route::match(['GET','POST'],'edit-product/{id}','ProductController@editProduct');
	Route::post('product-check','ProductController@checkProduct');
	//Prdouct group routes
	Route::match(['GET','POST'],'product-groups','ProductGroupsController@index');
	Route::post('product-group-check','ProductGroupsController@checkProductGroup');
	Route::match(['GET','POST'],'edit-product-groups/{id}','ProductGroupsController@editProductGroups');
	Route::post('delete-product-groups','ProductGroupsController@deleteProductGroup');
	//Product embed generator routes
	Route::match(['GET','POST'],'product-embed','ProductEmbedController@index');
	// Order Route
	Route::get('orders/{status?}','OrderController@index');
	Route::get('view-order/{id}','OrderController@orderView');
	Route::post('delete-order','OrderController@deleteOrder');
	//Coupons routes
	Route::get('coupons','CouponController@index');
	Route::match(['GET','POST'],'add-coupon','CouponController@addCoupon');
	Route::post('coupon-code-check','CouponController@checkCouponCode');
	Route::match(['GET','POST'],'edit-coupon/{id}','CouponController@editCoupon');
	Route::post('delete-coupon','CouponController@deleteCoupon');
	Route::post('number-of-coupon-uses','CouponController@numberOfCouponUses');

	//Review routes
	Route::get('feedbacks', 'ProductReviewController@index');
	Route::post('send-feedback', 'ProductReviewController@sendFeedback');

	// Marketing Route
	Route::match(['GET','POST'],'new-marketing','MarketingController@newMarketing');
	Route::match(['GET','POST'],'marketings','MarketingController@index');

	//Analytics Route
	Route::match(['GET','POST'],'analytics','AnalyticsController@index');

	//Affiliate Route
	Route::match(['GET','POST'],'affiliates','AffiliateController@index');
	Route::match(['GET','POST'],'payouts','AffiliateController@payouts');


	//Settings route
	Route::match(['GET','POST'],'settings/account','SettingsController@accountSettings');
	Route::match(['GET','POST'],'settings/payment','SettingsController@paymentSettings');
	Route::match(['GET','POST'],'settings/security','SettingsController@securitySettings');

});
//Routes for sellers page individual store
Route::group(['prefix' => 'sellers','namespace' => 'sellers'],function(){	
	Route::get('{username}','SettingsController@userStore');
});

//Routes for seller with prefix seller when logged in ends here

//Routes for individual product page from sellers
Route::group(['namespace' => 'sellers'],function(){
	//Route::get('buy/{username}/{product_uuid}','PaymentsController@getIndividualProductDetails');
	Route::match(['GET','POST'],'buy/{username}/{product_uuid}','PaymentsController@getIndividualProductDetails');
	Route::post('seller/product-coupon-code-check','PaymentsController@productCouponCodeCheck');
	Route::post('pay-now','PaymentsController@payNow');
	Route::get('payments/success', 'PaymentsController@success');
    Route::get('payments/cancel', 'PaymentsController@cancel');
    Route::post('review', 'ProductReviewController@newReview');
    Route::get('cancel-review/{username}', 'ProductReviewController@cancelReview');
    Route::post('product-view', 'ProductReviewController@productView');
});


//Routes for affiliate with prefix affiliate when not logged in starts here
Route::group(['prefix'=>'affiliates','namespace' => 'affiliates','middleware' => ['noAuth:users']],function(){
	Route::get('','DashboardController@login');
	Route::match(['GET','POST'],'login','DashboardController@login');
	
});
//Routes for affiliates with prefix affiliates when logged in starts here
Route::group(['prefix' => 'affiliates','namespace' => 'affiliates','middleware'=>['guest:users']],function(){
	
	Route::get('','DashboardController@index');
	Route::get('dashboard','DashboardController@index');
    Route::post('logout','DashboardController@logout');


    // Affiliates Product Route
    Route::match(['GET','POST'],'products','ProductController@index');

    // Affiliates Settings Route
    Route::match(['GET','POST'],'settings','SettingsController@index');


    // Affiliates Payouts Route
    Route::match(['GET','POST'],'payouts','PayoutController@index');

});


//Routes for individual product page from affiliates
Route::group(['namespace' => 'affiliates'],function(){
	Route::match(['GET','POST'],'buy/{username}/{product_uuid}/{affiliates}','PaymentsController@getIndividualProductDetails');
	
});
