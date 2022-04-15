<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::get('admin/register', function () {
    return redirect('/admin/login');
})->name('backpack.auth.register');


Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'),
        ['isAdmin']
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('event', 'EventCrudController');
    Route::crud('menu', 'MenuCrudController');
    Route::crud('menu-item', 'MenuItemCrudController');
    Route::crud('food-table', 'FoodTableCrudController');
    Route::crud('chair-table', 'ChairTableCrudController');
    Route::get('event/{event}/view-registrations-statistics', 'EventCrudController@viewRegistrationsStatistics')->name('show_registrations_statistics');
    Route::get('event/{event}/export-registrations-statistics', 'EventCrudController@exportRegistrationsStatistics')->name('export_registrations_statistics');
}); // this should be the absolute last line of this file
