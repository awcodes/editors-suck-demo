<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin/login');

Route::view('/editorjs', 'editorjs');

Route::get('/{page:slug}', PageController::class)->name('page.show');
