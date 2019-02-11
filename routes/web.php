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

// Route::get('/', function () {
//     return view('index');
// });
//主页
Route::get('/','IndexController@index');
//测试
Route::get('/test','testController@test');
// Route::view('/post', 'post');
// 发布
Route::get('/post', 'PostController@post');
// 详情
Route::middleware('throttle:60,1')->get('/post/{id}', 'PostController@info')->where('id','[0-9]+')->middleware('click');
// 发布保存
Route::post('/post/add', 'PostController@add');
// 注册
Route::get('/register', 'RegisterController@register');
// 注册保存
Route::middleware('throttle:10,1')->post('/register', 'RegisterController@adduser');
// 用户详情
Route::get('/user', 'UserController@info');
// 登录
Route::get('/login', 'LoginController@index');
// 登录验证
Route::middleware('throttle:10,1')->post('/login', 'LoginController@login');
// 下载
Route::middleware('throttle:10,1','download')->get('/download/upload/book/{path}/{name}', 'FileController@download');
// 封面
// Route::get('/bookcover/{title}', 'FileController@bookcover');
// 首页最新
Route::get('/new','IndexController@index')->name('new');
// 首页点击量
Route::get('/click','IndexController@index')->name('click');
// 点赞
Route::post('/admire/{type}/{id}', 'PostController@admire')->where(['type' => '^(post|comment)$', 'id' => '[0-9]+']);
//上传图片
Route::post('/upload/img/{type}', 'FileController@img')->where('type', '^(comment|post)$');
//上传图书
Route::post('/upload/book/{type}', 'FileController@book')->where('type', '^(book|cover)$');
//添加上传图书
Route::post('/upload/book/add/{id}', 'FileController@add');
// 发表评论
Route::middleware('throttle:10,1')->post('/post/{id}/comment', 'CommentController@add');
// 加入邮箱队列
Route::middleware('throttle:2,1')->get('/email/upload/book/{path}/{bookname}.{extension}' , 'MailController@mail');
// 推送测试邮件
Route::middleware('throttle:5,1')->get('/email/test/{email}', 'MailController@test');
// 退出登录
Route::get('/logout', 'LoginController@logout');
// 用户设置渲染
Route::get('/user', 'UserController@set');
// 用户设置提交
Route::post('/user/set', 'UserController@update');
// 用户kindle设置提交
Route::post('/user/set/kindle', 'UserController@kindle');
// 后台
Route::middleware(['admin'])->prefix('/admin')->group(function(){
	// 后台首页
	Route::get('index', 'AdminController@index');
	// 基本设置
	Route::post('setbase', 'AdminController@setbase');
	// 默认头像渲染
	Route::get('head', 'AdminController@head');
	// 图书列表
	Route::get('booklist', 'AdminController@booklist');
	// 图书审核
	Route::get('post/display/{id}', 'AdminController@display');
	// 图书删除
	Route::get('post/del/{id}', 'AdminController@del');
});