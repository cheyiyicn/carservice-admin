<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\{
    MemberController, PartnerStoreController, CarBrandController, CarBrandSeriesController
};

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    // Member in admin/auth.
    $router->resource('auth/members', MemberController::class);
    $router->resource('partner-stores', PartnerStoreController::class);
    // 车辆品牌车系管理
    $router->resource('car-brands', CarBrandController::class);
    $router->resource('car-brand-series', CarBrandSeriesController::class);
});
