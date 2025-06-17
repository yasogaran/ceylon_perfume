<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\Product\Form as ProductForm;
use App\Livewire\Admin\Category\Index as CategoryIndex;
use App\Livewire\Admin\Category\Form as CategoryForm;
use App\Livewire\Admin\Brand\Index as BrandIndex;
use App\Livewire\Admin\Brand\Form as BrandForm;
use App\Livewire\Admin\Tag\Index as TagIndex;
use App\Livewire\Admin\Tag\Form as TagForm;
use App\Livewire\Admin\Banner\Index as BannerIndex;
use App\Livewire\Admin\Banner\Form as BannerForm;
use App\Livewire\Admin\Contact\Index as ContactIndex;
use App\Livewire\Admin\Contact\Form as ContactForm;
use App\Livewire\Guest\Homepage;
use App\Livewire\Guest\ProductListing;
use App\Livewire\Guest\ProductShow;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', ProductIndex::class)->name('index');
        Route::get('/create', ProductForm::class)->name('create');
        Route::get('/{product}/edit', ProductForm::class)->name('edit');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('categories', CategoryIndex::class)->name('index');
        Route::get('categories/create', CategoryForm::class)->name('create');
        Route::get('categories/{category}/edit', CategoryForm::class)->name('edit');
    });

    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', BrandIndex::class)->name('index');
        Route::get('/create', BrandForm::class)->name('create');
        Route::get('/{brand}/edit', BrandForm::class)->name('edit');
    });

    Route::prefix('tags')->name('tags.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Tag\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Tag\Form::class)->name('create');
        Route::get('/{tag}/edit', \App\Livewire\Admin\Tag\Form::class)->name('edit');
    });

    Route::prefix('homepage')->name('homepage.')->group(function () {
        Route::get('/sections', \App\Livewire\Admin\Homepage\Sections::class)->name('sections');
        Route::get('/sections/create', \App\Livewire\Admin\Homepage\SectionForm::class)->name('sections.create');
        Route::get('/sections/{id}/edit', \App\Livewire\Admin\Homepage\SectionForm::class)->name('sections.edit');
        Route::get('/banners', \App\Livewire\Admin\Homepage\Banners::class)->name('banners');
    });

    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Menu\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Menu\Form::class)->name('create');
        Route::get('/{id}/edit', \App\Livewire\Admin\Menu\Form::class)->name('edit');
    });
});

Route::get('/', Homepage::class)->name('guest.homepage');
Route::get('/products', ProductListing::class)->name('products.index');
Route::get('/product/{slug}', ProductShow::class)->name('product.show');
require __DIR__ . '/auth.php';
