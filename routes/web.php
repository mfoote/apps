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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/launch', [App\Http\Controllers\HomeController::class, 'index'])->name('launch')->middleware('auth');

Route::get('/web_forms', [App\Http\Controllers\WebFormController::class, 'index'])->name('web_forms')->middleware('auth');
Route::post('/web_forms/trash', [App\Http\Controllers\WebFormController::class, 'trash'])->name('web_forms.trash')->middleware('auth');
Route::post('/web_forms/convert', [App\Http\Controllers\WebFormController::class, 'convert'])->name('web_forms.convert')->middleware('auth');

Route::get('/web_calls', [App\Http\Controllers\WebCallController::class, 'index'])->name('web_calls')->middleware('auth');
Route::post('/web_calls/convert', [App\Http\Controllers\WebCallController::class, 'convert'])->name('web_calls.convert')->middleware('auth');

Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports')->middleware('auth');

Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts')->middleware('auth');
Route::post('/contacts/lookup', [App\Http\Controllers\ContactController::class, 'lookup'])->name('contacts.lookup')->middleware('auth');
Route::get('/contacts/list', [App\Http\Controllers\ContactController::class, 'listIndex'])->name('contacts.list')->middleware('auth');
Route::get('/contacts/list/{letter}', [App\Http\Controllers\ContactController::class, 'listResult'])->name('contacts.list.result')->middleware('auth');
Route::get('/contacts/edit/{id}', [App\Http\Controllers\ContactController::class, 'edit'])->name('contacts.edit')->middleware('auth');
Route::post('/contacts/update/{id}', [App\Http\Controllers\ContactController::class, 'update'])->name('contacts.update')->middleware('auth');
Route::post('/contacts/store/status', [App\Http\Controllers\ContactController::class, 'storeStatus'])->name('contacts.store.status')->middleware('auth');
Route::post('/contacts/store/note', [App\Http\Controllers\ContactController::class, 'storeNote'])->name('contacts.store.note')->middleware('auth');
Route::post('/contacts/link/emr/{id}', [App\Http\Controllers\ContactController::class, 'linkEmr'])->name('contacts.link.emr')->middleware('auth');
Route::get('/contacts/note/close/fu/{id}', [App\Http\Controllers\ContactController::class, 'closeFollowUp'])->name('contacts.close.fu')->middleware('auth');
Route::get('/emr/lookup/form/{id}', [App\Http\Controllers\CareCloudController::class, 'lookupForm'])->name('emr.lu.form')->middleware('auth');
Route::post('/emr/lookup/result/{id}', [App\Http\Controllers\CareCloudController::class, 'lookupResult'])->name('emr.lu.result')->middleware('auth');
