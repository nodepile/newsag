<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ArticleController as ArticleControllerV1;

Route::prefix('v1')
    ->group(function() {

        Route::prefix('articles')
            ->controller(ArticleControllerV1::class)
            ->group(function() {

                Route::get('/', 'index');

            });
    });