<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(config('admin.route.middleware'))->get('/partner-stores', function (Request $request) {
    $amapKey = env("AMAP_KEY");
    $address = $request->query("address");
    if (isset($address) && strlen($address) == 0) {
        response([], 200);
        return;
    } 

    $url = "https://restapi.amap.com/v3/geocode/geo?key=%s&address=%s";
    $response = Http::get(sprintf($url, $amapKey), $address);
    dd($response);
    if ($response->ok()) {
        dd($response->body());
    }
});
