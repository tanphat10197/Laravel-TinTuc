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
Auth::routes();
//Tạo Route cho Admin
Route::group(['prefix'=>'admin', 'middleware'=>'adminlogin'],function(){
	Route::group(['prefix'=>'theloai'], function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');

		Route::get('sua/{id}','TheLoaiController@getSua');
		Route::post('sua/{id}','TheLoaiController@postSua');


		Route::get('them','TheLoaiController@getThem');
		Route::post('them','TheLoaiController@postThem');

		Route::get('xoa/{id}', 'TheLoaiController@getXoa');
	});

	Route::group(['prefix'=>'loaitin'], function(){
		Route::get('danhsach','LoaiTinController@getDanhSach');

		Route::get('sua/{id}','LoaiTinController@getSua');
		Route::post('sua/{id}','LoaiTinController@postSua');


		Route::get('them','LoaiTinController@getThem');
		Route::post('them','LoaiTinController@postThem');

		Route::get('xoa/{id}', 'LoaiTinController@getXoa');
	});

	Route::group(['prefix'=>'tintuc'], function(){
		Route::get('danhsach','TinTucController@getDanhSach');

		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');


		Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');

		Route::get('xoa/{id}', 'TinTucController@getXoa');
	});

	Route::group(['prefix'=>'slide'], function(){
		Route::get('danhsach','SlideController@getDanhSach');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');


		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}', 'SlideController@getXoa');
	});

	Route::group(['prefix'=>'user'], function(){
		Route::get('danhsach','UserController@getDanhSach');

		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');


		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		Route::get('xoa/{id}', 'UserController@getXoa');
	});

	Route::group(['prefix'=>'comment'], function(){
		Route::get('xoa/{id}/{idtintuc}', 'CommentController@getXoa');
	});
});

Route::get('dangnhap','UserController@getAdminDangNhap');
Route::post('dangnhap','UserController@postAdminDangNhap')->name('admin.dangnhap');
Route::get('dangxuat','UserController@getAdminDangXuat');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//ROUTE TRANG CHỦ-------------------------
Route::get('trangchu', 'PageController@trangchu');
Route::get('lienhe', 'PageController@lienhe');

//ROUTE LOAI TIN
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin');
//ROUTE TIN TUC
Route::get('tintuc/{id}/{TenKhongDau}.html','PageController@tintuc');
Route::post('comment/{id}', 'CommentController@postComment');