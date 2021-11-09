<?php

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

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', 'HomeController@home')->name('home');
    //================================================================
    //==============================Apps==============================
    //================================================================
    //trang quản lý phòng
    Route::prefix('/room')->group(function () {
        Route::get('/', [
            'as' => 'room.index',
            'uses' => 'apps\RoomController@index'
        ]);
        Route::get('/create', [
            'as' => 'room.create',
            'uses' => 'apps\RoomController@create'
        ]);
        Route::post('/store', [
            'as' => 'room.store',
            'uses' => 'apps\RoomController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'room.edit',
            'uses' => 'apps\RoomController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'room.update',
            'uses' => 'apps\RoomController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'room.delete',
            'uses' => 'apps\RoomController@delete'
        ]);
        Route::get('/device/{id}', [
            'as' => 'room.device',
            'uses' => 'apps\RoomController@device'
        ]);
    });
    //tran quản lý danh mục thiết bị
    Route::prefix('/category-device')->group(function () {
        Route::get('/', [
            'as' => 'category-device.index',
            'uses' => 'apps\CategoryDeviceController@index'
        ]);
        Route::get('/create', [
            'as' => 'category-device.create',
            'uses' => 'apps\CategoryDeviceController@create'
        ]);
        Route::post('/store', [
            'as' => 'category-device.store',
            'uses' => 'apps\CategoryDeviceController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'category-device.edit',
            'uses' => 'apps\CategoryDeviceController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'category-device.update',
            'uses' => 'apps\CategoryDeviceController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'category-device.delete',
            'uses' => 'apps\CategoryDeviceController@delete'
        ]);
    });
    //trang quản lý lịch sử thiết bị
    Route::prefix('/history')->group(function () {
        Route::get('/', [
            'as' => 'history.index',
            'uses' => 'apps\HistoryDeviceController@index'
        ]);
        Route::get('/detail/{code}', [
            'as' => 'history.detail',
            'uses' => 'apps\HistoryDeviceController@detail'
        ]);
    });
    //trang quản lý văn bản mua sắm
    Route::prefix('/document')->group(function () {
        Route::get('/', [
            'as' => 'document.index',
            'uses' => 'apps\DocumentDeviceController@index'
        ]);
        Route::get('/create', [
            'as' => 'document.create',
            'uses' => 'apps\DocumentDeviceController@create'
        ]);
        Route::post('/store', [
            'as' => 'document.store',
            'uses' => 'apps\DocumentDeviceController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'document.edit',
            'uses' => 'apps\DocumentDeviceController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'document.update',
            'uses' => 'apps\DocumentDeviceController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'document.delete',
            'uses' => 'apps\DocumentDeviceController@delete'
        ]);
        Route::post('/approve/{id}', [
            'as' => 'document.approve',
            'uses' => 'apps\DocumentDeviceController@approve'
        ]);
        Route::post('/refuse/{id}', [
            'as' => 'document.refuse',
            'uses' => 'apps\DocumentDeviceController@refuse'
        ]);
        Route::get('/info/{id}', [
            'as' => 'document.info',
            'uses' => 'apps\DocumentDeviceController@info'
        ]);
        Route::post('/export/{id}', [
            'as' => 'document.export',
            'uses' => 'apps\DocumentDeviceController@export'
        ]);
    });
    //trang quản lý thiết bị
    Route::prefix('/device')->group(function () {
        Route::get('/', [
            'as' => 'device.index',
            'uses' => 'apps\DeviceController@index'
        ]);
        Route::post('/active/{id}', [
            'as' => 'device.active',
            'uses' => 'apps\DeviceController@active'
        ]);
        Route::post('/inactive/{id}', [
            'as' => 'device.inactive',
            'uses' => 'apps\DeviceController@inactive'
        ]);
        Route::post('/error/{id}', [
            'as' => 'device.error',
            'uses' => 'apps\DeviceController@error'
        ]);
        Route::post('/fixing/{id}', [
            'as' => 'device.fixing',
            'uses' => 'apps\DeviceController@fixing'
        ]);
        Route::post('/liquidate/{id}', [
            'as' => 'device.liquidate',
            'uses' => 'apps\DeviceController@liquidate'
        ]);
    });
    //trang quản lý văn bản bàn giao
    Route::prefix('/handover')->group(function () {
        Route::get('/', [
            'as' => 'handover.index',
            'uses' => 'apps\HandoverController@index'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'handover.edit',
            'uses' => 'apps\HandoverController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'handover.update',
            'uses' => 'apps\HandoverController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'handover.delete',
            'uses' => 'apps\HandoverController@delete'
        ]);
        Route::post('/approve/{id}', [
            'as' => 'handover.approve',
            'uses' => 'apps\HandoverController@approve'
        ]);
        Route::get('/info/{id}', [
            'as' => 'handover.info',
            'uses' => 'apps\HandoverController@info'
        ]);
        Route::get('/export/{id}', [
            'as' => 'handover.export',
            'uses' => 'apps\HandoverController@export'
        ]);
        Route::post('/exportOneRoom/{id}', [
            'as' => 'handover.exportOneRoom',
            'uses' => 'apps\HandoverController@exportOneRoom'
        ]);
        Route::post('/exportManyRoom/{id}', [
            'as' => 'handover.exportManyRoom',
            'uses' => 'apps\HandoverController@exportManyRoom'
        ]);
        Route::post('/exportOnly/{id}', [
            'as' => 'handover.exportOnly',
            'uses' => 'apps\HandoverController@exportOnly'
        ]);
    });
    //trang quản lý văn bản dự trù
    Route::prefix('/device-plan')->group(function () {
        Route::get('/', [
            'as' => 'device-plan.index',
            'uses' => 'apps\DevicePlanController@index',
        ]);
        Route::get('/create', [
            'as' => 'device-plan.create',
            'uses' => 'apps\DevicePlanController@create',
        ]);
        Route::post('/store', [
            'as' => 'device-plan.store',
            'uses' => 'apps\DevicePlanController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'device-plan.edit',
            'uses' => 'apps\DevicePlanController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'device-plan.update',
            'uses' => 'apps\DevicePlanController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'device-plan.delete',
            'uses' => 'apps\DevicePlanController@delete',
        ]);
        Route::get('/info/{id}', [
            'as' => 'device-plan.info',
            'uses' => 'apps\DevicePlanController@info',
        ]);
        Route::post('/approve/{id}', [
            'as' => 'device-plan.approve',
            'uses' => 'apps\DevicePlanController@approve'
        ]);
        Route::post('/refuse/{id}', [
            'as' => 'device-plan.refuse',
            'uses' => 'apps\DevicePlanController@refuse'
        ]);
        Route::post('/is-buy/{id}', [
            'as' => 'device-plan.is-buy',
            'uses' => 'apps\DevicePlanController@isBuyUpdate'
        ]);
        Route::post('/export/{id}', [
            'as' => 'device-plan.export',
            'uses' => 'apps\DevicePlanController@export'
        ]);
    });
    //trang quản lý văn bản thanh lý
    Route::prefix('/liquidate')->group(function () {
        Route::get('/', [
            'as' => 'liquidate.index',
            'uses' => 'apps\LiquidateController@index',
        ]);
        Route::post('/create', [
            'as' => 'liquidate.create',
            'uses' => 'apps\LiquidateController@create',
        ]);
        Route::post('/store', [
            'as' => 'liquidate.store',
            'uses' => 'apps\LiquidateController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'liquidate.edit',
            'uses' => 'apps\LiquidateController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'liquidate.update',
            'uses' => 'apps\LiquidateController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'liquidate.delete',
            'uses' => 'apps\LiquidateController@delete',
        ]);
        Route::get('/info/{id}', [
            'as' => 'liquidate.info',
            'uses' => 'apps\LiquidateController@info',
        ]);
        Route::post('/approve/{id}', [
            'as' => 'liquidate.approve',
            'uses' => 'apps\LiquidateController@approve'
        ]);
        Route::post('/refuse/{id}', [
            'as' => 'liquidate.refuse',
            'uses' => 'apps\LiquidateController@refuse'
        ]);
        Route::post('/liquidated/{id}', [
            'as' => 'liquidate.liquidated',
            'uses' => 'apps\LiquidateController@liquidated'
        ]);
    });
    //Tạo báo cáo
    Route::prefix('/report')->group(function () {
        Route::get('/', [
            'as' => 'report.index',
            'uses' => 'apps\ReportsController@index'
        ]);
    });
    //Kiểm kê trên sổ
    Route::prefix('/inventory')->group(function () {
        Route::get('/', [
            'as' => 'inventory.index',
            'uses' => 'apps\InventoryController@index'
        ]);
        Route::get('/create', [
            'as' => 'inventory.create',
            'uses' => 'apps\InventoryController@create'
        ]);
        Route::post('/store', [
            'as' => 'inventory.store',
            'uses' => 'apps\InventoryController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'inventory.edit',
            'uses' => 'apps\InventoryController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'inventory.update',
            'uses' => 'apps\InventoryController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'inventory.delete',
            'uses' => 'apps\InventoryController@delete'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'inventory.detail',
            'uses' => 'apps\InventoryController@detail'
        ]);
    });
    //Kiểm kê trên máy
    Route::prefix('/auto-inventory')->group(function () {
        Route::get('/', [
            'as' => 'auto-inventory.index',
            'uses' => 'apps\AutoInventoryController@index'
        ]);
        Route::get('/create', [
            'as' => 'auto-inventory.create',
            'uses' => 'apps\AutoInventoryController@create'
        ]);
        Route::post('/store', [
            'as' => 'auto-inventory.store',
            'uses' => 'apps\AutoInventoryController@store'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'auto-inventory.detail',
            'uses' => 'apps\AutoInventoryController@detail'
        ]);
    });
    Route::prefix('/device-group')->group(function () {
        Route::get('/', [
            'as' => 'device-group.index',
            'uses' => 'apps\DeviceGroupController@index'
        ]);
        Route::get('/create', [
            'as' => 'device-group.create',
            'uses' => 'apps\DeviceGroupController@create'
        ]);
        Route::post('/store', [
            'as' => 'device-group.store',
            'uses' => 'apps\DeviceGroupController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'device-group.edit',
            'uses' => 'apps\DeviceGroupController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'device-group.update',
            'uses' => 'apps\DeviceGroupController@update'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'device-group.detail',
            'uses' => 'apps\DeviceGroupController@detail'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'device-group.delete',
            'uses' => 'apps\DeviceGroupController@delete'
        ]);
    });
    //================================================================
    //================================================================
    //================================================================

    //============================================================================
    //===================================AJAX=====================================
    //============================================================================
    /*=*/   Route::get('document/{id}', 'apps\AuthorController@getData'); //xem thông tin văn bản mua sắm
    /*=*/   Route::get('rooms/{id}', 'apps\AuthorController@getRoom'); //xem danh sách phòng
    /*=*/   Route::get('ajax-device-plan', 'apps\AuthorController@getDevicePlan'); //xem danh sách văn bản dự trù đã duyệt
    /*=*/   Route::get('ajax-document', 'apps\AuthorController@getDocument'); //xem danh sách văn bản dự trù đã duyệt
    /*=*/   Route::get('developing', 'apps\AuthorController@developing'); //thông báo tính năng đang phát triển
    /*=*/   Route::get('liquidateDevice', 'apps\AuthorController@getDeviceLiquidate'); //xem danh sách thiết bị chờ thanh lý
    //=============================================================================
    //=================================END AJAX====================================
    //=============================================================================

    Auth::routes();

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('users', 'UsersController')->except(['create', 'store']);
        Route::resource('roles', 'RolesController');
        Route::get('/roles/move/move-up', 'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down', 'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () {
            Route::get('/', 'MenuElementController@index')->name('menu.index');
            Route::get('/move-up', 'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down', 'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create', 'MenuElementController@create')->name('menu.create');
            Route::post('/store', 'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents', 'MenuElementController@getParents');
            Route::get('/edit', 'MenuElementController@edit')->name('menu.edit');
            Route::post('/update', 'MenuElementController@update')->name('menu.update');
            Route::get('/show', 'MenuElementController@show')->name('menu.show');
            Route::get('/delete', 'MenuElementController@delete')->name('menu.delete');
        });

        Route::prefix('menu/menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('menu.menu.index');
            Route::get('/create', 'MenuController@create')->name('menu.menu.create');
            Route::post('/store', 'MenuController@store')->name('menu.menu.store');
            Route::get('/edit', 'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update', 'MenuController@update')->name('menu.menu.update');
            Route::get('/delete', 'MenuController@delete')->name('menu.menu.delete');
        });

    });

    Route::get('dangxuat', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('dangxuat');
});
