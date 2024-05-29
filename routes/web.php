<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin/login');

Route::get('/{page:slug}', PageController::class)->name('page.show');
