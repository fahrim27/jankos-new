<?php


use Illuminate\Support\Facades\Artisan;
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

// Route::get('generate', function (){
//     \Illuminate\Support\Facades\Artisan::call('storage:link');
//     echo 'ok';
// });

Route::get('/', 'HomeController@home')->name('home');

Auth::routes(['verify' => true]);

Route::resource('photoboot', 'PhotobootController');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::get('/all-member/index', 'AllMemberController@allMeber')->name('all-member.index');
Route::get('/detail-member/{id}', 'AllMemberController@showFromAll')->name('detail-member.show');


Route::group(['middleware' => ['auth','verified']], function () {
    
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('setting', 'SettingController@index')->name('setting.index');

    Route::post('setting/user', 'SettingController@updateUser')->name('setting.updateUser');

    Route::post('setting/category-update', 'SettingController@updateCategory')->name('setting.updateCategory');

    Route::post('setting/password', 'SettingController@updatePassword')->name('setting.updatePassword');

    Route::post('setting/business', 'SettingController@updateBusiness')->name('setting.updateBusiness');

    Route::post('setting/mailer', 'SettingController@updateMailer')->name('setting.updateMailer');

    Route::get('setting/profile', 'ProfileController@create')->name('setting.indexProfile');

    Route::post('setting/profile', 'ProfileController@store')->name('setting.storeProfile');

    // Route::get('sliders', 'SliderController@index')->name('sliders.index');

    // Route::get('sliders/create', 'SliderController@create')->name('sliders.create');

    // Route::post('sliders/create', 'SliderController@store')->name('sliders.store');

    // Route::delete('sliders/{id}/delete', 'SliderController@destroy')->name('sliders.destroy');

    // Route::get('sponsors', 'SponsorController@index')->name('sponsor.index');

    // Route::get('sponsor/create', 'SponsorController@create')->name('sponsor.create');
    // Route::get('sponsor/edit/{id}', 'SponsorController@edit')->name('sponsor.edit');
    // Route::put('sponsor/update/{id}', 'SponsorController@update')->name('sponsor.update');
    
    // Route::get('business/edit/{id}', 'CompanyController@edit_status')->name('business.edit');
    // Route::put('business/update/{id}', 'CompanyController@update_status')->name('business.update');

    // Route::post('sponsor/create', 'SponsorController@store')->name('sponsor.store');

    // Route::delete('sponsor/{id}/delete', 'SponsorController@destroy')->name('sponsor.destroy');
    
    // Route::get('video', 'VideoController@index')->name('video.index');

    // Route::get('video/create', 'VideoController@create')->name('video.create');

    // Route::post('video/create', 'VideoController@store')->name('video.store');

    // Route::delete('video/{id}/delete', 'VideoController@destroy')->name('video.destroy');

    
    // Route::get('kategori', 'CategoryController@index')->name('category.index');

    // Route::get('kategori/create', 'CategoryController@create')->name('category.create');

    // Route::post('kategori/create', 'CategoryController@store')->name('category.store');

    // Route::delete('kategori/{id}/delete', 'CategoryController@destroy')->name('category.destroy');
    

    Route::resource('users', 'UserController');



    // Route::resource('packages', 'PackageController');

    // Route::post('subscriptions/{id}/action', 'SubscriptionController@action')->name('subscriptions.action');

    // Route::resource('subscriptions', 'SubscriptionController');

    // Route::get('jobs/{id}/apply', 'JobController@getApply')->name('jobs.getApply');

    // Route::post('jobs/{id}/apply', 'JobController@apply')->name('jobs.apply');

    // Route::get('jobs/{id}/approval/{action}', 'JobController@getApproval')->name('jobs.getApproval');

    // Route::post('jobs/{id}/action', 'JobController@action')->name('jobs.action');

    // Route::resource('jobs', 'JobController');
    // Route::get('jobs/{slug}', 'JobController@show2')->name('jobs.show2');

    // Route::resource('applicants', 'JobApplicantController');

    // Route::get('detail/{id}/applicants', 'JobApplicantController@detail')->name('applicants.detail');

    Route::resource('articles', 'ArticleController');

    Route::resource('guides', 'GuideController');
    
    Route::resource('access-request', 'CompanyController');

    Route::resource('teams', 'TeamController')->except([
        'create'
    ]);
    Route::get('teams/create/{id}', 'TeamController@create')->name('teams.create');
    
    Route::resource('documents', 'DocumentController');
    Route::resource('videos', 'VideoController');
    Route::resource('logbooks', 'LogbookController');
    Route::resource('transfers', 'TransferController');
    Route::resource('members', 'MemberController');

    Route::resource('all-teams', 'AllTeamController');
    Route::get('/all-teams/documents/{id}', 'AllTeamController@showDocument')->name('all-teams.documents');
    Route::get('/all-teams/logbooks/{id}', 'AllTeamController@showLogbook')->name('all-teams.logbooks');
    Route::get('/all-teams/members/{id}', 'AllTeamController@showMember')->name('all-teams.members');
    Route::get('/all-teams/adds/{id}', 'AllTeamController@showAdd')->name('all-teams.adds');

    Route::resource('photo-contest', 'PhotoContestController');

    //Route::get('mitra', 'CompanyController@detail_perusahaan')->name('mitra.list');

    // Route::resource('users', 'UserController');

    // Route::resource('materi', 'MateriController');

    // Route::resource('video', 'VideoController');

    // Route::post('task/{id}/submit', 'TaskController@submit')->name('task.submit');

    // Route::resource('task', 'TaskController');

    // Route::post('soal/exam/answer', 'SoalController@storeAnswer')->name('soal.storeAnswer');

    // Route::post('soal/exam/finish', 'SoalController@examFinish')->name('soal.examFinish');

    // Route::post('soal/{id}/item', 'SoalController@storeItem')->name('soal.storeItem');

    // Route::post('soal/{id}/exam', 'SoalController@examStart')->name('soal.examStart');

    // Route::resource('soal', 'SoalController');

    // Route::get('home/notifications', 'HomeController@loadMoreNotifications');

    // Route::post('home/feed', 'HomeController@feed')->name('home.feed');

    // Route::post('home/reply', 'HomeController@reply')->name('home.reply');



    // Route::get('activity', 'ReportController@activity')->name('report.activity');

    // Route::post('nilai', 'ReportController@saveNilai')->name('report.saveNilai');

    // Route::get('nilai', 'ReportController@nilai')->name('report.nilai');



    // Route::get('setting', 'HomeController@setting')->name('home.setting');

    // Route::post('setting', 'HomeController@updateSetting')->name('home.updateSetting');

    // Route::post('password', 'HomeController@updatePassword')->name('home.updatePassword');

});