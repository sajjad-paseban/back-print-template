<?php

use App\Http\Controllers\InitDataTemplateController;
use App\Http\Controllers\PrintTemplateController;
use App\Http\Controllers\PrintTemplateGroupController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::prefix('print')->group(function () {
        // group
        Route::get('groupList', [PrintTemplateGroupController::class, 'groupList']);
        Route::delete('groupDelete/{id}', [PrintTemplateGroupController::class, 'groupDelete']);
        Route::get('groupItem/{id}', [PrintTemplateGroupController::class, 'groupItem']);
        Route::post('groupAdd', [PrintTemplateGroupController::class, 'groupAdd']);
        Route::put('groupUpdate/{id}', [PrintTemplateGroupController::class, 'groupUpdate']);
        // template
        Route::get('templateList', [PrintTemplateController::class, 'templateList']);
        Route::get('templateItem/{id}', [PrintTemplateController::class, 'templateItem']);
        Route::delete('templateDelete/{id}', [PrintTemplateController::class, 'templateDelete']);
        Route::post('templateAdd', [PrintTemplateController::class, 'templateAdd']);
        Route::put('templateUpdate/{id}', [PrintTemplateController::class, 'templateUpdate']);
        // initTemplateData
        Route::get('init_data', [InitDataTemplateController::class, 'get_init_data']);

    });
});
