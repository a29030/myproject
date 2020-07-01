<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@index')->name("index");

//Xem tin tức
Route::group(['prefix' => 'blog'], function() {
    Route::get('/', 'HomeController@blog')->name('blog');

    //Xem chi tiết tin tức
    Route::get('detailnew', 'HomeController@detailnew')->name('detailnew');
    Route::post('postcomment','userController@postcomment')->name('postcomment');
    Route::get('deletecomment', 'userController@deletecomment')->name('deletecomment');
    Route::get('editcomment', 'userController@editcomment')->name('editcomment');

    //Tìm tin tức
    Route::get('search', 'HomeController@searchnew')->name('searchnew');
});

//Xem tin tức theo danh mục
Route::get('blog/{category}', 'HomeController@detailcategory')->name('detailcategory');

//tra ve chi tiet san pham
Route::get('ctsp', 'HomeController@ctsp')->name('ctsp');

//nguoi dung review san pham
Route::post('ctsp','userController@addreview')->name('addreview');

//nguoi dung sua review san pham cua minh
Route::post('editreview','userController@editreview')->name('editreview');

//nguoi dung them comment vao san pham
Route::post('addcomment','userController@addcomment')->name('addcomment');

//nguoi dung lien he voi nguoi quan tri
Route::get('contact', 'HomeController@contact')->name('contact');
Route::post('contact','HomeController@sendinfor')->name('contact');

//dang nhap
Route::get('login', 'userController@login')->name('login');
Route::post('login','userController@check')->name('plogin');

//dang xuat
Route::get('logout','userController@logout')->name('logout');

Route::get('register', 'userController@register')->name('register');
Route::post('register','userController@pregister')->name('pregister');

Route::get('myorder', 'userController@myorder')->name('myorder');
Route::get('cancelorder', 'userController@cancelorder')->name('cancelorder');

Route::group(['prefix' => 'account','middleware'=>'accountMiddleware'], function () {
    //lay ra thong tin nguoi dung
    Route::get('/', 'userController@account')->name('account');

    //nguoi dung update thong tin cua minh
    Route::post('/','userController@updateAccount')->name('updateaccount');

    //thuc hien doi mat khau
    Route::post('changepassword','userController@changepassword')->name('changepassword');

});

//chinh sach
Route::get('policy', 'HomeController@policy')->name('policy');

//dang ky
Route::get('register', 'userController@register')->name('register');
Route::post('register','userController@pregister')->name('pregister');

//show tat ca san pham
Route::get('shop', 'HomeController@shop')->name('shop');

//tim kiem san pham
Route::get('search','HomeController@search')->name('search');

//gio hang
Route::group(['prefix' => 'cart'], function () {
    //them san pham vao gio hang
    Route::get('addcart','userController@addCart')->name('addcart');

    //reset gio hang
    Route::get('resetcart','userController@resetCart')->name('resetcart');

    //giam san pham trong gio hang xuong theo id
    Route::get('updatecartdown','userController@updateCartDown')->name('updatecartdown');

    //tang san pham trong gio hang theo id
    // Route::get('updatecartup/{id}','userController@updateCartUp')->name('updatecartup');
    Route::get('updatecartup','userController@updateCartUp')->name('updatecartup');

    //cap nhat lai so luong san pham co trong gio hang
    Route::get('updatecountcartup','userController@updateCountCartUp')->name('updatecountcartup');

    //cap nhat lai so luong san pham co trong gio hang
    Route::get('updatecountcartdown','userController@updateCountCartDown')->name('updatecountcartdown');

    //xoa san pham theo id co trong gio hang
    Route::get('deletecart/{id}','userController@deleteCart')->name('deletecart');

    //check code giam gia
    Route::get('checkcode','userController@checkcode')->name('checkcode');

    //xoa code khi khong muon su dung nua
    Route::get('forgetcode','userController@forgetcode')->name('forgetcode');
});

//xem gio hang
Route::get('checkout','userController@getCart')->name('getcart');


Route::group(['prefix' => 'wishlist'], function() {
    Route::get('/','userController@wishlist')->name('wishlist');

    //thêm sản phẩm vào danh sách yêu thích
    Route::get('addwishlist/{id}','userController@addwishlist')->name('addwishlist');

    //Xóa sản phẩm khỏi danh sách yêu thích
    Route::get('deletewishlist/{id}','userController@deletewishlist')->name('deletewishlist');
});

//Xem danh sách sản phẩm yêu thích
Route::get('wishlist','userController@wishlist')->name('wishlist');

//thanh toan
Route::get('payment','userController@payment')->name('payment');

Route::post('payment','userController@postPayment')->name('completeorder');

Route::get('shop/{slug_name}','HomeController@getProductWithCategory')->name('getproductwithcategory');


Route::group(['prefix' => 'admin','middleware'=>'adminMiddleware'], function() {
    Route::get('/', 'adminController@admin')->name('admin');

    Route::get('addproduct','adminController@addproduct')->name('addproduct');
    Route::post('addproduct','adminController@postaddproduct')->name('addproduct');

    Route::get('product','adminController@product')->name('product');
    Route::get('searchproduct','adminController@searchproduct')->name('searchproduct');

    Route::get('deleteproduct','adminController@deleteproduct')->name('deleteproduct');

    Route::get('editproduct','adminController@editproduct')->name('editproduct');
    Route::post('editproduct','adminController@posteditproduct')->name('editproduct');

    Route::get('manageorder','adminController@manageorder')->name('manageorder');

    Route::get('detailorder','adminController@detailorder')->name('detailorder');

    Route::post('processorder','adminController@processorder')->name('processorder');

    Route::get('contact','adminController@contact')->name('admin-contact');

    //show danh sach tat ca cau hoi cua khach
    Route::get('contact','adminController@contact')->middleware('adminMiddleware')->name('admin-contact');

    //show danh sach tat ca cau hoi cua khach
    Route::get('contact','adminController@contact')->name('admin-contact');

    //bieu do thong ke doanh so nam truoc va nam nay
    Route::get('chart','adminController@chart')->name('admin-chart');

    //chi tiet cau hoi cua khach va form reply
    Route::get('detailmessage/{id}','adminController@detailmessage')->name("detailmessage");

    //chi tiet cau hoi cua khach va from reply
    Route::post('detailmessage/{id}','adminController@postdetailmessage')->name("postdetailmessage");

    //show danh sach user
    Route::get('listuser','adminController@getAllUsers')->name("showlistuser");
    //edit user
    Route::get('edituser','adminController@getedituser')->name("getedituser");
    Route::post('edituser','adminController@postedituser')->name("postedituser");
    //xoa user
    Route::get('deleteuser','adminController@deleteUser')->name("deleteuser");

    //show profile cua 1 tai khoan
    Route::get('profile','adminController@getProfile')->name("profile");

    //xu ly ham post khi update profile
    Route::post('profile','adminController@updateProfile')->name("updateprofile");

    //admin tim kiem nguoi dung
    Route::get('searchuser','adminController@searchUser')->name("adminsearchuser");

    //admin tim kiem nguoi dung trong route message(cau hoi tu nguoi dung)
    Route::get('searchmessage','adminController@searchMessage')->name("adminsearchcontact");

});
Route::get('userprofile','adminController@getProfile')->name("userprofile");

//xu ly ham post khi update profile
Route::post('userprofile','adminController@updateProfile')->name("updateprofile");
