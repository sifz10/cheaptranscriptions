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
	$environment = 'local';
	$landing = TRUE;
	if(App::environment('production')) {
		$environment = 'production';
		\URL::forceScheme('https');

	}
    return view('index', array('landing' => TRUE,'environment' => $environment, 'landing' =>$landing));
});


Route::get('/how-it-works', function () {
	$environment = 'local';

	if(App::environment('production')) {
		$environment = 'production';
	}
	return view('howitworks', array('environment' => $environment));
});

Route::get('/privacy', function () { return view('privacy');});

Route::get('/terms', function () { return view('terms');});



Route::group(['middleware' => ['is_sub']], function () {
	Route::post('/newtranscription', 'TranscriptionJobController@newtranscription');
	Route::post('/processpayment', 'TranscriptionJobController@processpayment');
	Route::get('/transcribestatus/{transcribejobid}', 'TranscriptionJobController@transcribestatus');
	Route::get('/reviewtranscription/{transcribejobid}', 'TranscriptionJobController@reviewtranscription');
	Route::get('/word/{transcribejobid}', 'DocumentController@outputWord');
	Route::post('/updatetranscription', 'TranscriptionJobController@updatetranscription');
	Route::get('/reviewpassword/{transcribejobid}', 'TranscriptionJobController@reviewpassword');
	Route::post('/checktranscriptionpassword', 'TranscriptionJobController@checktranscriptionpassword');
	Route::get('/user-dashboard', 'UserController@UserDashboard')->name('user.dashboard');
	Route::get('/user/trnsactions/results/{id}', 'UserController@seeTransDetails')->name('user.trans.details');
	Route::get('/invited/user', 'UserController@invitedUser')->name('user.invite.users');
	Route::post('/sent/user/invite', 'UserController@invitedUserPost')->name('user.invite.users.sent');
	Route::get('/user/delete/{id}', 'UserController@DeleteUser')->name('user.users.delete');

	Route::get('/users/transcriptions/start/', 'UserController@startNewTranscriptions')->name('user.new.transcription');
});


Auth::routes();
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/subscribe', 'SubscriptionController@subscribePackage')->name('subscribePackage');
Route::get('/admin/awsjobs', 'AdminController@awsjobs')->name('adminawslog');
Route::get('/fail/{transcribejobid}', 'AdminController@failit')->name('adminfail');
Route::post('upload', array('middleware' => 'cors', 'uses' => 'chunkedFileUpload@upload'));



Route::group(['middleware' => ['auth']], function () {
Route::get('/subcription/payment/{id}', 'SubscriptionController@gettingPaid')->name('gettingPaid');
Route::post('/subcription/payment/charge', 'SubscriptionController@paymentProccess')->name('paymentProccess');
});
// Packages And Subcription Start
Route::get('/admin/plans','PlanController@index')->name('plans.index');
Route::get('admin/create/plan','SubscriptionController@createPlan')->name('create.plan');
Route::post('admin/store/plan','SubscriptionController@storePlan')->name('store.plan');
Route::get('/admin/edit/plan/{id}','SubscriptionController@editPlan')->name('edit.plan');
Route::get('/admin/pause/plan/{id}','SubscriptionController@pausePlan')->name('admin.pause.plan');
Route::get('/admin/active/plan/{id}','SubscriptionController@activePlan')->name('admin.active.plan');

// Route::get('plan-status-{id}','PlanController@PlanStatus')->name('PlanStatus');
// Route::get('plan-delete-{id}','PlanController@DeletePackages')->name('DeletePackages');
// Packages And Subcription End


Route::get('/logout', function () {
    $id = Auth::id();
    Auth::logout();
    return redirect('/login');
})->name('logout');
