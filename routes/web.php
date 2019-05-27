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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/login', 'UserController@login')->name('login');
Route::any('/logout', 'UserController@logout')->name('logout');
Route::any('/register', 'UserController@register')->name('register');

Route::middleware('radasm.auth.administrator')->group(function () {
	Route::prefix('admin')->group(function () {
        Route::match('get', '', 'Admin\HomeController@index')->name('admin.index');
		Route::match(['get', 'post'], 'user', 'Admin\UserController@get_list');
		Route::match('post', 'user/edit', 'Admin\UserController@get_one');
		Route::match('post', 'user/save', 'Admin\UserController@save');
		Route::match('post', 'user/status', 'Admin\UserController@status');
		Route::match('post', 'user/delete', 'Admin\UserController@delete');

		Route::match(['get', 'post'], 'assessment_category', 'Admin\AssessmentController@get_categories');
		Route::match('post', 'assessment_category/delete', 'Admin\AssessmentController@delete_category');
		Route::match('get', 'assessment_category/edit/{id}', 'Admin\AssessmentController@get_category');
		Route::match('get', 'assessment_category/detail/{id}', 'Admin\AssessmentController@get_detail');
		Route::match('post', 'assessment_category/save', 'Admin\AssessmentController@save_category')->name('assessment_category.save');

		Route::match(['get', 'post'], 'university_category', 'Admin\UniversityController@get_categories');
		Route::match('post', 'university_category/edit', 'Admin\UniversityController@get_category');
		Route::match('post', 'university_category/save', 'Admin\UniversityController@save_category');
		Route::match('post', 'university_category/delete', 'Admin\UniversityController@delete_category');

		Route::match(['get', 'post'], 'assessment', 'Admin\AssessmentController@get_list');
		Route::match('post', 'assessment/view', 'Admin\AssessmentController@get_one');
		Route::match('post', 'assessment/universities', 'Admin\AssessmentController@get_universities');
		Route::match('post', 'assessment/accept', 'Admin\AssessmentController@accept');
		Route::match('post', 'assessment/accept_visa', 'Admin\AssessmentController@accept_visa');
		Route::match('post', 'assessment/reject', 'Admin\AssessmentController@reject');

		Route::match(['get', 'post'], 'university', 'Admin\UniversityController@get_list');
		Route::match('post', 'university/accept', 'Admin\UniversityController@accept');
		Route::match('post', 'university/reject', 'Admin\UniversityController@reject');

		Route::match(['get', 'post'], 'payment', 'Admin\PaymentController@get_list');
		Route::match(['post'], 'payment/accept', 'Admin\PaymentController@accept');
		Route::match(['post'], 'payment/reject', 'Admin\PaymentController@reject');

		Route::match(['get', 'post'], 'uploaddocs', 'Admin\UploadController@get_list');
		Route::match('post', 'uploaddocs/reject', 'Admin\UploadController@reject');
		Route::match('post', 'uploaddocs/accept', 'Admin\UploadController@accept');
		Route::match('post', 'uploaddocs/detail', 'Admin\UploadController@detail');

		Route::match(['get', 'post'], 'admission', 'Admin\AdmissionController@get_list');

		Route::match(['get', 'post'], 'invoice', 'Admin\InvoiceController@get_list');
		Route::match('post', 'invoice/reply', 'Admin\InvoiceController@reply');
		Route::match('post', 'invoice/detail', 'Admin\InvoiceController@detail');
	});

	// Section CoreUI elements
	Route::view('/sample/dashboard','samples.dashboard');
	Route::view('/sample/buttons','samples.buttons');
	Route::view('/sample/social','samples.social');
	Route::view('/sample/cards','samples.cards');
	Route::view('/sample/forms','samples.forms');
	Route::view('/sample/modals','samples.modals');
	Route::view('/sample/switches','samples.switches');
	Route::view('/sample/tables','samples.tables');
	Route::view('/sample/tabs','samples.tabs');
	Route::view('/sample/icons-font-awesome', 'samples.font-awesome-icons');
	Route::view('/sample/icons-simple-line', 'samples.simple-line-icons');
	Route::view('/sample/widgets','samples.widgets');
	Route::view('/sample/charts','samples.charts');

});

Route::middleware('radasm.auth.user')->group(function () {
	Route::match('get', '', 'User\HomeController@index')->name('user.index');
    Route::match('get', '/recent/message/count', 'User\HomeController@getRecentMessageCount')->name('user.getRecentMessageCount');
    Route::match('get', '/messageBrowsed', 'User\MessageController@messageBrowsed')->name('user.messageBrowsed');
    Route::match('post', '/replyMessage', 'User\MessageController@replyMessage')->name('user.replyMessage');
    Route::match('get', '/deleteMessage', 'User\MessageController@deleteMessage')->name('user.deleteMessage');
	Route::match('get', '/assessment/visa','User\HomeController@apply_visa');
    Route::match('get', '/assessment/study','User\HomeController@apply_study');
	Route::match('post', 'assessment/register', 'User\AssessmentController@register')->name('assessment.register');
    Route::match('get', '/university/{activity_id}', 'User\UniversityController@index')->name('university.index');
    Route::match('post', '/policy/register', 'User\PolicyController@register')->name('policy.register');
    Route::match('get', '/policy/visa/{assessment_id}', 'User\PolicyController@policyVisa')->name('policy.visa');
    Route::match('get', '/policy/study/{activity_id}', 'User\PolicyController@policyStudy')->name('policy.study');
    Route::match('get', '/pay/{activity_id}', 'User\PayController@index')->name('pay.index');
    Route::match('post', '/pay/register', 'User\PayController@register')->name('pay.register');
    Route::match('get', '/upload/{activity_id}', 'User\UploadController@index')->name('upload.index');
    Route::match('post', '/upload/save/doc-name', 'User\UploadController@storeDocName');
    Route::match('post', '/upload/register', 'User\UploadController@register')->name('upload.register');
    Route::match('get', '/admission/{activity_id}', 'User\AdmissionController@index')->name('admission.index');
    Route::match('post', '/admission/confirm', 'User\AdmissionController@confirm')->name('admission.confirm');
    Route::match('get', '/finish/{activity_id}', 'User\FinishController@index')->name('finish.index');
    Route::view('/sample/dashboard','samples.dashboard');
    Route::view('/sample/buttons','samples.buttons');
    Route::view('/sample/social','samples.social');
    Route::view('/sample/cards','samples.cards');
    Route::view('/sample/forms','samples.forms');
    Route::view('/sample/modals','samples.modals');
    Route::view('/sample/switches','samples.switches');
    Route::view('/sample/tables','samples.tables');
    Route::view('/sample/tabs','samples.tabs');
    Route::view('/sample/icons-font-awesome', 'samples.font-awesome-icons');
    Route::view('/sample/icons-simple-line', 'samples.simple-line-icons');
    Route::view('/sample/widgets','samples.widgets');
    Route::view('/sample/charts','samples.charts');
});

/*
Route::middleware('auth')->group(function() {
	Route::view('/', 'panel.blank');
	// Section elements
	Route::view('/assessment', 'pages.assessment');
	Route::view('/university', 'pages.university');
	Route::view('/policy', 'pages.policy');
	Route::view('/payment', 'pages.payment');
	Route::view('/upload', 'pages.upload');
	Route::view('/admission', 'pages.admission');
	Route::view('/inbox', 'pages.message');

	Route::get('/user/category', 'UserController@category');
	Route::view('/assessment/category', 'admin.assessment_category');
	Route::view('/university/category', 'admin.university_category');
	Route::view('/assessment/edit/1', 'admin.assessment');
	Route::view('/assessment/list', 'admin.assessment_list');
	Route::view('/university/list', 'admin.university_list');
	Route::view('/policy/list', 'admin.policy_list');
	Route::view('/payment/list', 'admin.payment_list');
	Route::view('/upload/list', 'admin.upload_list');
	Route::view('/admission/list', 'admin.admission_list');

	// Section CoreUI elements
	Route::view('/sample/dashboard','samples.dashboard');
	Route::view('/sample/buttons','samples.buttons');
	Route::view('/sample/social','samples.social');
	Route::view('/sample/cards','samples.cards');
	Route::view('/sample/forms','samples.forms');
	Route::view('/sample/modals','samples.modals');
	Route::view('/sample/switches','samples.switches');
	Route::view('/sample/tables','samples.tables');
	Route::view('/sample/tabs','samples.tabs');
	Route::view('/sample/icons-font-awesome', 'samples.font-awesome-icons');
	Route::view('/sample/icons-simple-line', 'samples.simple-line-icons');
	Route::view('/sample/widgets','samples.widgets');
	Route::view('/sample/charts','samples.charts');
});
 *
 */
// Section Pages

/* CoreUI templates */

Route::view('/sample/error404','errors.404')->name('error404');
Route::view('/sample/error500','errors.500')->name('error500');