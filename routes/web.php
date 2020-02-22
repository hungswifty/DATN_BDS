<?php



// De rieng login de xu ly
Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'as' => 'admin.',
], function(){
	Route::get('/login','LoginController@index')->name(
		'login');
	Route::post('handle-login','LoginController@handleLogin')->name('handle-login');
});


Route::get('/', function () {
    // return view('mainsite.index.index');
});

Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin', //khu vuc chua controller
	'as' => 'admin.',
	'middleware' => ['check.admin.login','web']
], function(){
	Route::get('dashboard','DashboardController@index')->name(
		'dashboard');
	// phan name chinh la action tu ben form (view)
	Route::get('/logout','LoginController@logout')->name('logout');

	// Them bai viet
	Route::get('/add-post','PostArticlesController@addPostIndex')->name('add-post');
	Route::post('/add-post','PostArticlesController@addPostHandle')->name('add-post-handle');
	// Sua bai viet
	Route::get('/edit-post','PostArticlesController@editPostIndex')->name('edit-post');
	Route::get('/edit-post/getData','PostArticlesController@getDataforDisplayAll')->name('edit-post.getData');



	Route::get('/edit-post/{news_id}','PostArticlesController@editPostDetail')->name('edit-post-details');
	Route::post('/edit-post/','PostArticlesController@editPostHandle')->name('edit-post-handle');
	Route::get('/delete-post/{news_id}','PostArticlesController@deletePost')->name('delete-post');
	Route::get('/restore-post','PostArticlesController@restorePost')->name('restore-post');

	// PRODUCT
	//
	Route::get('add-product','ProductController@addProductIndex')->name('add-product');
	Route::post('add-product','ProductController@addProductHandle')->name('add-product-handle');

		//hien thi table
	Route::get('display-allproduct','ProductController@displayAllProduct')->name('display-allproduct');
		//lay du lieu
	Route::get('display-allproduct/getData','ProductController@dataForDisplayAllProduct')->name('product.getData');


	Route::get('/edit-product/{product_id}','ProductController@editProductDetail')->name('edit-product-details');
	Route::post('/edit-product/','ProductController@editProductHandle')->name('edit-product-handle');
	Route::get('/delete-product/{product_id}','ProductController@deleteProduct')->name('delete-product');
	Route::get('/restore-product','ProductController@restoreProduct')->name('restore-product');

	// IMAGE
	//
	Route::get('add-image','ImageController@addImageIndex')->name('add-image');
	Route::post('add-image','ImageController@addImageHandle')->name('add-image-handle');


	Route::get('display-allimage','ImageController@displayAllImage')->name('display-allimage');
	//lay du lieu
	Route::get('display-allimage/getData','ImageController@dataForDisplayAllImage')->name('image.getData');


	Route::get('/edit-image/{image_id}','ImageController@editImageDetail')->name('edit-image-details');
	Route::post('/edit-image','ImageController@editImageHandle')->name('edit-image-handle');
	
	Route::get('/delete-image/{image_id}','ImageController@deleteImage')->name('delete-image');
	Route::get('/restore-image','ImageController@restoreImage')->name('restore-image');

	//THONG KE
	//ngdung
	Route::get('statistic-user','StatisticController@indexUser')->name('user-statistic');
	Route::get('statistic-user/getData','StatisticController@statisUser')->name('userStat.getData');
	//tinrao
	Route::get('statistic-product','StatisticController@indexProduct')->name('product-statistic');
	Route::get('statistic-product/getData','StatisticController@statisProduct')->name('productStat.getData');

	//USER
	Route::get('add-user','UserController@addUserIndex')->name('add-user');
	Route::post('add-user','UserController@addUserHandle')->name('add-user-handle');

	Route::get('display-user','UserController@displayAllUser')->name('display-alluser');
	//lay du lieu
	Route::get('display-user/getData','UserController@dataForDisplayAllUser')->name('user.getData');
	
	Route::get('/edit-user/{user_id}','UserController@editUserDetail')->name('edit-user-details');
	Route::post('/edit-user','UserController@editUserHandle')->name('edit-user-handle');

	Route::get('/delete-user/{user_id}','UserController@deleteUser')->name('delete-user');
	Route::get('/restore-user','UserController@restoreUser')->name('restore-user');


	//PRODUCT CATEGORY
	
	Route::get('add-productcate','ProductCategoryController@addProductCateIndex')->name('add-productcate');
	Route::post('add-productcate','ProductCategoryController@addProductCateHandle')->name('add-productcate-handle');


	Route::get('display-productcate','ProductCategoryController@displayAllProCate')->name('display-allProCate');
	//lay du lieu
	Route::get('display-productcate/getData','ProductCategoryController@dataForDisplayAllProCate')->name('proCate.getData');

	Route::get('/edit-productcate/{proCate_id}','ProductCategoryController@editProCateDetail')->name('edit-productcate-details');
	Route::post('/edit-productcate','ProductCategoryController@editProCateHandle')->name('edit-productcate-handle');

	Route::get('/delete-productcate/{proCate_id}','ProductCategoryController@deleteProCate')->name('delete-productcate');
	Route::get('/restore-productcate','ProductCategoryController@restoreProCate')->name('restore-productcate');

	//REPORT
	//
	
	Route::get('display-report','ReportController@displayReport')->name('display-allreport');
	//lay du lieu
	Route::get('display-report/getData','ReportController@dataForDisplayAllReport')->name('report.getData');


	Route::get('/delete-report/{report_id}','ReportController@deleteReport')->name('delete-report');
	Route::get('/restore-report','ReportController@restoreReport')->name('restore-report');

});


Route::group([
	'prefix' => 'news',
	'namespace' => 'MainSite',  //vi tri folder chua Controller
	'as' => 'news.' //dat ten cho group , vi du goi ten bat ki mot route nao deu phai them news. vao truoc 
],function(){
	Route::get('','NewsController@index')->name('newsindex');
	Route::get('detail/{news_id}/{tieude}','NewsController@detail')->name('details');
	Route::post('detail/{news_id}/{tieude?}','NewsController@comment')->name('comment')->middleware('check.user.login');

});

//Dung trung controller
Route::group([
	'namespace' => 'MainSite',
],function(){
	Route::get('/','IndexController@index')->name('trangchu');
	Route::get('/login','LoginController@index')->name('login');
	Route::post('/login','LoginController@handleLogin')->name('handle-login');
	Route::get('logout','LoginController@handleLogout')->name('logout')->middleware('check.user.login');
	Route::get('register','RegisterController@index')->name('register');
	Route::post('register','RegisterController@registerHandle')->name('register-handle');
	Route::get('forgotpw','ForgotPwController@index')->name('forgotpw');
	Route::post('forgotpw','ForgotPwController@handle')->name('sendmail');
	Route::get('upload-sp','UploadProductController@index')->name('upload-product')->middleware('check.user.login');
	Route::post('upload-sp','UploadProductController@handleUpload')->name('upload-product-handle');
	Route::get('product-detail/{product_id}/{product_title}','ProductDetailController@index')->name('product-detail');
	Route::get('selling-pd','ProductAreaController@selling')->name('selling-product');
	Route::get('renting-pd','ProductAreaController@renting')->name('renting-product');
	Route::get('search-result','ProductAreaController@searching')->name('searching-product');

	Route::get('test','TestController@index')->name('test');

	Route::GET('dynamic_dependent/fetchTT', 'TestController@fetchTT')->name('tinh_thanh.fetch');
	Route::GET('dynamic_dependent/fetchQH', 'TestController@fetchQH')->name('quan_huyen.fetch');

	Route::post('send-report', 'ReportPostController@handleReport')->name('send-report');

	Route::get('about','ContactController@about')->name('about');
	Route::get('contact','ContactController@contact')->name('contact');
});

Route::group([
	'prefix' => 'user-page',
	'namespace' => 'User',
	'as' => 'user.',
	'middleware' => 'check.user.login',
],function(){
	Route::get('index','UserController@index')->name(
		'index');
	Route::get('change-info','UserController@changeInfo')->name('change-info');
	Route::post('change-info','UserController@changeInfoHandle')->name('change-info-handle');
	Route::get('change-pw','UserController@changePw')->name('change-pw');
	Route::post('change-pw','UserController@changePwHandle')->name('changePwHandle');
	Route::get('user-product','UserController@userProduct')->name('user-product');
	Route::get('edit-product/{id_sanpham}','UserController@editProduct')->name('edit-product');
	Route::post('edit-product/{id_sanpham}','UserController@editProductHandle')->name('edit-productHandle');
	Route::get('mailbox','UserController@mailIndex')->name('mailbox');
	Route::get('mail-detail/{mail_id}/{tieu_de}','UserController@mailDetail')->name('mail-detail');
	Route::get('mail-send/{mail_id?}/','UserController@mailSend')->name('mail-send');
	Route::post('mail-send/{mail_id?}','UserController@mailSendHandle')->name('mail-sendHandle');

	Route::get('message-sender/{sanpham_id?}','UserController@messSender')->name('messSender');
	Route::post('message-sender/{sanpham_id?}','UserController@messSenderHandle')->name('messSenderHandle');

	Route::get('mail-delete/{mail_id}','UserController@mailDelete')->name('mail-delete');


});

