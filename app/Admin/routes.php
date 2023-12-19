<?php

use App\Admin\Controllers\{
    MemberController, PartnerStoreController, CarBrandController, CarBrandSeriesController,
    UserOrderController,
};
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Encore\Admin\Facades\Admin;

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
    // 订单相关
    $router->resource('user-orders', UserOrderController::class);
});
