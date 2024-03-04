<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Landing page - rename as home later...
Route::get('fft_summary', 'FeedbackController@summary')->middleware('auth');;
Route::get('fft_summary/getdata', 'FeedbackController@getSummary')->name('fft_summary/getdata')->middleware('auth');;

Route::get('feedback', 'FeedbackController@detail')->middleware('auth');;
Route::get('feedback/getdata', 'FeedbackController@getDetail')->name('feedback/getdata')->middleware('auth');

// SDE REMOVE LATER
Route::get('feedback2', 'FeedbackController@detail2')->middleware('auth');;
Route::get('feedback2/getdata', 'FeedbackController@getDetail2')->name('feedback/getdata')->middleware('auth');
// SDE REMOVE LATER

Route::get('allstats', 'FeedbackController@allstats')->middleware('auth');;
Route::get('allstats/getdata', 'FeedbackController@getAllStats')->name('allstats/getdata')->middleware('auth');

Route::get('analysis', 'FeedbackController@analysis')->middleware('auth');;
Route::get('analysis/getdata', 'FeedbackController@getAllStats')->name('analysis/getdata')->middleware('auth');

Route::get('themes', 'ThemesController@themes')->middleware('auth');;
Route::get('themes/getdata', 'ThemesController@getAllStats')->name('themes/getdata')->middleware('auth');

Route::get('fullinfo', 'FeedbackController@fullinfo')->middleware('auth');;
Route::get('fullinfo/getdata', 'FeedbackController@getFullInfo')->name('fullinfo/getdata')->middleware('auth');

Route::get('prefs/update', 'PrefsController@updatePrefs')->name('prefs/update')->middleware('auth');
Route::post('prefs/update', 'PrefsController@updatePrefs')->name('prefs/update')->middleware('auth');
Route::get('prefs/save', 'PrefsController@savePrefs')->name('prefs/save')->middleware('auth');

Route::get('zeros', 'ResponsesController@zeros')->middleware('admin');
Route::get('zeros/save', 'ResponsesController@saveZeros')->name('zeros/save')->middleware('auth');
Route::get('zeros/confirm', 'ResponsesController@confirm')->name('zeros/confirm')->middleware('auth');
Route::get('search', 'ResponsesController@search')->middleware('admin');
Route::post('search', 'ResponsesController@search')->name('search')->middleware('admin');
Route::get('response/{id}', 'ResponsesController@response')->middleware('admin');

Route::get('updateResponse', 'ResponsesController@updateResponse')->name('updateResponse')->middleware('admin');

Route::get('chart', 'FeedbackController@chart')->middleware('auth');

Route::get('words', 'WordsController@displayWords')->middleware('auth');
Route::get('word', 'WordsController@feedbackByWord')->middleware('auth');
Route::get('wordtest', 'WordsController@test')->middleware('auth');

Route::get('refdata', 'RefDataController@index')->middleware('auth');
Route::post('refdata', 'RefDataController@index')->middleware('auth');
Route::post('refdata/store', 'RefDataController@store')->name('refdata/store')->middleware('auth');
Route::post('refdata/update', 'RefDataController@update')->name('refdata/update')->middleware('auth');
Route::get('refdata/getdata', 'RefDataController@getdata')->name('refdata/getdata')->middleware('auth');
Route::get('refdata/missingref', 'RefDataController@missingref')->name('refdata/missingref')->middleware('auth');

Route::get('changePassword','FeedbackController@showChangePasswordForm');
Route::post('changePassword','FeedbackController@changePassword')->name('changePassword');

Route::get('test','TestController@create');
Route::post('test','TestController@store')->name('test.store');

Route::get('cryfft','WebFFTController@create');
Route::post('cryfft','WebFFTController@store')->name('cryfft.store');

Route::get('meht','MEHTController@create')->name('meht.create');
Route::post('meht','MEHTController@store')->name('meht.store');

Route::get('upload', 'UploadController@index')->middleware('auth');
Route::post('upload/load', 'UploadController@load')->name('upload.load')->middleware('auth');
Route::post('upload/process', 'UploadController@process')->name('upload.process')->middleware('auth');
Route::match(['get', 'post'],'upload/validateFile', 'UploadController@validateFile')->name('upload.validateFile')->middleware('auth');

Route::get("registered", function(){
    return View::make("registered");
});

//laravel-users
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
    ]);

    Route::resource('paperentry', 'PaperController');
    Route::post('paperentry/create','PaperController@create');

    Route::resource('webfft', 'WebFFTController');

    Route::resource('qrcodes','QRController', [
        'names' => [
            'index' => 'screen'
        ]
    ]);
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');
});

Route::get('routes', function() {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='80%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});
