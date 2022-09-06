<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LotController;
use App\Http\Controllers\Admin\DrawController;
use App\Http\Controllers\Admin\joinController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserBondController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\PriceListController;
use App\Http\Controllers\Admin\BondSeriesController;
use App\Http\Controllers\Admin\PrizeWinnerController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\AuthenticationController;
use Illuminate\Support\Facades\Redirect;

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
Route::get('/', function() {
    return Redirect()->route('dashboard');
});
// login
Route::get('admin', [AuthenticationController::class, 'login'])->name('login');
Route::post('admin', [AuthenticationController::class, 'AuthCheck'])->name('login.check');

Route::group(['middleware' => ['auth']] , function(){
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // logout
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::put('/admin', [AuthenticationController::class, 'passwordUpdate'])->name('password.change');
    // Create user
    Route::get('/registration', [RegistrationController::class, 'index'])->name('register.create');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('register.store');

    Route::get('/settings', [RegistrationController::class, 'settings'])->name('settings');
    Route::put('/registration', [RegistrationController::class, 'profileUpdate'])->name('register.update');

    Route::get('/price-list', [PriceListController::class, 'index'])->name('price-list');
    Route::post('/price-list/store', [PriceListController::class, 'store'])->name('price-list.store');
    Route::get('/price-list/edit/{id}', [PriceListController::class, 'edit'])->name('price-list.edit');
    Route::post('/price-list/update/{id}', [PriceListController::class, 'update'])->name('price-list.update');
    Route::get('/price-list/delete/{id}', [PriceListController::class, 'delete'])->name('price-list.delete');

    Route::get('/draw-all', [DrawController::class, 'index'])->name('draw.all');
    Route::post('/draw/store', [DrawController::class, 'store'])->name('draw.store');
    Route::get('/draw/edit/{id}', [DrawController::class, 'edit'])->name('draw.edit');
    Route::post('/draw/update/{id}', [DrawController::class, 'update'])->name('draw.update');
    Route::get('/draw/delete/{id}', [DrawController::class, 'delete'])->name('draw.delete');

    Route::get('/client-all', [ClientController::class, 'index'])->name('client.all');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::post('/client/update/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::get('/client/delete/{id}', [ClientController::class, 'delete'])->name('client.delete');

    Route::get('bond-series', [BondSeriesController::class, 'index'])->name('bond-series');
    Route::post('/bond-series/store', [BondSeriesController::class, 'store'])->name('bond-series.store');
    Route::get('/bond-series/edit/{id}', [BondSeriesController::class, 'edit'])->name('bond-series.edit');
    Route::post('/bond-series/update/{id}', [BondSeriesController::class, 'update'])->name('bond-series.update');
    Route::get('/bond-series/delete/{id}', [BondSeriesController::class, 'delete'])->name('bond-series.delete');

    Route::get('lot', [LotController::class, 'index'])->name('lot');
    Route::post('/lot/store', [LotController::class, 'store'])->name('lot.store');
    Route::get('/lot/edit/{id}', [LotController::class, 'edit'])->name('lot.edit');
    Route::post('/lot/update/{id}', [LotController::class, 'update'])->name('lot.update');
    Route::get('/lot/delete/{id}', [LotController::class, 'delete'])->name('lot.delete');

    Route::get('/price-winner-list', [PrizeWinnerController::class, 'index'])->name('price-winner');
    Route::post('/price-winner-list/store', [PrizeWinnerController::class, 'store'])->name('price-winner.store');
    Route::get('/price-winner-list/edit/{id}', [PrizeWinnerController::class, 'edit'])->name('price-winner.edit');
    Route::post('/price-winner-list/update/{id}', [PrizeWinnerController::class, 'update'])->name('price-winner.update');
    Route::get('/price-winner-list/delete/{id}', [PrizeWinnerController::class, 'delete'])->name('price-winner.delete');

    Route::get('/userbond', [UserBondController::class, 'index'])->name('userbond');
    Route::post('/userbond/store', [UserBondController::class, 'store'])->name('userbond.store');
    Route::get('/userbond/edit/{id}', [UserBondController::class, 'edit'])->name('userbond.edit');
    Route::post('/userbond/update/{id}', [UserBondController::class, 'update'])->name('userbond.update');
    Route::get('/userbond/delete/{id}', [UserBondController::class, 'delete'])->name('userbond.delete');

    // lot-list
    Route::get('/lot/list', [UserBondController::class, 'lotlist'])->name('lot.list');
    //User Bond By Lot
    Route::get('/lot/list/{id}', [UserBondController::class, 'bondWithLot'])->name('bond.with.lot');

    //User Bond By Sell
    Route::get('/lots/userbond/{id}', [UserBondController::class, 'bondinLots'])->name('lotsUserBonds');

    Route::get('/draw', [joinController::class, 'index'])->name('draw');
    Route::get('/draw-lot/{id}', [joinController::class, 'drawWithLot'])->name('draw-lot');

    Route::get('/sales', [UserBondController::class, 'sales'])->name('sales');
    // Ajax request route
    Route::get('/saleswithlot/{id?}', [UserBondController::class, 'salesWithLot'])->name('saleswithlot');
    Route::post('/status-change', [UserBondController::class, 'status'])->name('status');

    Route::get('/sold', [UserBondController::class, 'sold'])->name('sold');

    // Route in Report
    Route::get('/report/all', [UserBondController::class, 'allbond'])->name('report.all');
    Route::get('/report-draw', [joinController::class, 'reportDraw'])->name('report.draw');
    Route::post('/report-load', [joinController::class, 'reportLoad'])->name('report.load');

    // Ajax request route
    Route::post('/reportWithfilter', [UserBondController::class, 'reportWithfilter'])->name('reportWithfilter');

});