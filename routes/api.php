<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], static function () {

    Route::get('/user', static function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});
