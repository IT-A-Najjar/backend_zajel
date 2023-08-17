<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExcurslonController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\WagonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Driver
Route::get('driver',[DriverController::class,'index']);
Route::post('driversearch',[DriverController::class,'search']);
Route::get('driver/{id}',[DriverController::class,'show']);
Route::post('driver',[DriverController::class,'store']);
Route::post('driver/{id}',[DriverController::class,'update']);
Route::delete('driver/{id}',[DriverController::class,'destroy']);
//Wagon
Route::get('wagon',[WagonController::class,'index']);
Route::post('wagonsearch',[WagonController::class,'search']);
Route::get('wagon/{id}',[WagonController::class,'show']);
Route::post('wagon',[WagonController::class,'store']);
Route::post('wagon/{id}',[WagonController::class,'update']);
Route::delete('wagon/{id}',[WagonController::class,'destroy']);
//Region
Route::get('region',[RegionController::class,'index']);
Route::post('region_search',[RegionController::class,'search']);
Route::get('region/{id}',[RegionController::class,'show']);
Route::post('region',[RegionController::class,'store']);
Route::post('region/{id}',[RegionController::class,'update']);
Route::delete('region/{id}',[RegionController::class,'destroy']);
//Line
Route::get('line',[LineController::class,'index']);
Route::post('line_search',[LineController::class,'search']);
Route::get('line/{id}',[LineController::class,'show']);
Route::post('line',[LineController::class,'store']);
Route::post('line/{id}',[LineController::class,'update']);
Route::delete('line/{id}',[LineController::class,'destroy']);
//Position
Route::get('position',[PositionController::class,'index']);
Route::post('position_search',[PositionController::class,'search']);
Route::get('position/{id}',[PositionController::class,'show']);
Route::post('position',[PositionController::class,'store']);
Route::post('position/{id}',[PositionController::class,'update']);
Route::delete('position/{id}',[PositionController::class,'destroy']);
//Excursions
Route::get('excursion',[ExcurslonController::class,'index']);
Route::post('excursion_search',[ExcurslonController::class,'search']);
Route::get('excursion/{id}',[ExcurslonController::class,'show']);
Route::post('excursion',[ExcurslonController::class,'store']);
Route::post('excursion/{id}',[ExcurslonController::class,'update']);
Route::delete('excursion/{id}',[ExcurslonController::class,'destroy']);