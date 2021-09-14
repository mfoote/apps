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

Route::get('/launch', [App\Http\Controllers\HomeController::class, 'index'])->name('launch');

Route::get('/web_forms', [App\Http\Controllers\WebFormController::class, 'index'])->name('web_forms');
Route::post('/web_forms/trash', [App\Http\Controllers\WebFormController::class, 'trash'])->name('web_forms.trash');
Route::post('/web_forms/convert', [App\Http\Controllers\WebFormController::class, 'convert'])->name('web_forms.convert');

Route::get('/web_calls', [App\Http\Controllers\WebCallController::class, 'index'])->name('web_calls');
Route::post('/web_calls/convert', [App\Http\Controllers\WebCallController::class, 'convert'])->name('web_calls.convert');

Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports');

Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('contacts');
Route::post('/contacts/lookup', [App\Http\Controllers\ContactController::class, 'lookup'])->name('contacts.lookup');
