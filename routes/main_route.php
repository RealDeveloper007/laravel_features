<?php

use App\Http\Middleware\CheckStatus;
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

// Route::middleware([CheckStatus::class])->group(
//     function () {

Route::get('/', function () {
    return view('welcome');
});
//     }
// );

includeRouteFiles(__DIR__ . '/backend/');
