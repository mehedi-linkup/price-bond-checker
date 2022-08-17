<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserBondController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\PriceBondController;
use App\Http\Controllers\admin\PriceListController;
use App\Http\Controllers\Admin\BondSeriesController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\joinController;
use App\Http\Controllers\Admin\LotController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/submenu/{id}', [HomeController::class, 'submenu'])->name('submenu');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');
Route::get('/product-detail/{id}', [HomeController::class, 'productDetail'])->name('productDetail');
// serarch route
Route::get('/get_suggestions/{k}', [HomeController::class, 'getSearchSuggestions']);
Route::get('/search', [HomeController::class, 'productSearch'])->name('search');
// login
Route::get('admin', [AuthenticationController::class, 'login'])->name('login');
Route::post('admin', [AuthenticationController::class, 'AuthCheck'])->name('login.check');

Route::group(['middleware' => ['auth']] , function(){
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // logout
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::put('/admin', [AuthenticationController::class, 'passwordUpdate'])->name('password.change');
    // company profile 
    Route::get('company-profile', [CompanyProfileController::class, 'edit'])->name('company.edit');
    Route::put('company-profile/{company}', [CompanyProfileController::class, 'update'])->name('company.update');

    // Create user
    Route::get('/registration', [RegistrationController::class, 'index'])->name('register.create');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('register.store');

    Route::get('/settings', [RegistrationController::class, 'settings'])->name('settings');
    Route::put('/registration', [RegistrationController::class, 'profileUpdate'])->name('register.update');

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');

    // Subcategory Routes
    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('admin.subcategories');
    Route::post('/subcategory/store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::get('/subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.delete');

    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');
    Route::get('/product/subcategory/get/{subcat_id}', [ProductController::class, 'getSubCate'])->name('admin.product.get.subcat');

    // Service Route
    Route::get('/services', [ServiceController::class, 'service'])->name('service');
    Route::post('service/insert', [ServiceController::class, 'serviceInsert'])->name('store.service');
    Route::get('service/edit/{id}', [ServiceController::class, 'serviceEdit'])->name('edit.service');
    Route::post('service/update/{id}', [ServiceController::class, 'serviceUpdate'])->name('update.service');
    Route::get('service/delete/{id}', [ServiceController::class, 'serviceDelete'])->name('delete.service');
    
    // Gallery Route
    Route::get('/galleries', [GalleryController::class, 'gallery'])->name('gallery');
    Route::post('gallery/insert', [GalleryController::class, 'galleryInsert'])->name('store.gallery');
    Route::get('gallery/edit/{id}', [GalleryController::class, 'galleryEdit'])->name('edit.gallery');
    Route::post('gallery/update/{id}', [GalleryController::class, 'galleryUpdate'])->name('update.gallery');
    Route::get('gallery/delete/{id}', [GalleryController::class, 'galleryDelete'])->name('delete.gallery');
    
    // Management Route
    Route::get('managements', [ManagementController::class, 'index'])->name('management.index');
    Route::post('management/store', [ManagementController::class, 'store'])->name('management.store');
    Route::get('management/edit/{id}', [ManagementController::class, 'edit'])->name('management.edit');
    Route::post('management/update/{id}', [ManagementController::class, 'update'])->name('management.update');
    Route::get('management/delete/{id}', [ManagementController::class, 'delete'])->name('management.delete');
    
    Route::get('/messages', [MessageController::class, 'message'])->name('admin.message');
    Route::get('messages/delete/{id}', [MessageController::class, 'messageDelete'])->name('admin.message.delete');
    
    Route::get('/queries', [QueryController::class, 'query'])->name('admin.query');
    Route::get('queries/delete/{id}', [QueryController::class, 'queryDelete'])->name('admin.query.delete');

    Route::resource('/partner', PartnerController::class)->except('show', 'create');

    Route::get('/price-list', [PriceListController::class, 'index'])->name('price-list');
    Route::post('/price-list/store', [PriceListController::class, 'store'])->name('price-list.store');
    Route::get('/price-list/edit/{id}', [PriceListController::class, 'edit'])->name('price-list.edit');
    Route::post('/price-list/update/{id}', [PriceListController::class, 'update'])->name('price-list.update');
    Route::get('/price-list/delete/{id}', [PriceListController::class, 'delete'])->name('price-list.delete');

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

    Route::get('/price-winner-list', [PriceBondController::class, 'priceWinner'])->name('price-winner');
    Route::post('/price-winner-list/store', [PriceBondController::class, 'store'])->name('price-winner.store');
    Route::get('/price-winner-list/edit/{id}', [PriceBondController::class, 'edit'])->name('price-winner.edit');
    Route::post('/price-winner-list/update/{id}', [PriceBondController::class, 'update'])->name('price-winner.update');
    Route::get('/price-winner-list/delete/{id}', [PriceBondController::class, 'delete'])->name('price-winner.delete');

    Route::get('/userbond', [UserBondController::class, 'index'])->name('userbond');
    Route::post('/userbond/store', [UserBondController::class, 'store'])->name('userbond.store');
    Route::get('/userbond/edit/{id}', [UserBondController::class, 'edit'])->name('userbond.edit');
    Route::post('/userbond/update/{id}', [UserBondController::class, 'update'])->name('userbond.update');
    Route::get('/userbond/delete/{id}', [UserBondController::class, 'delete'])->name('userbond.delete');
    
    Route::get('/matchbond', [joinController::class, 'index'])->name('joint');
});