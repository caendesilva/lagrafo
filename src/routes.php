<?php

use Illuminate\Support\Facades\Route;
use DeSilva\Lagrafo\DocumentationController;

Route::get('/docs/{page?}', function (string $page = null) {
    return (new DocumentationController())->show($page);
})->name('docs');

Route::post('/api/docs/search', [
    DocumentationController::class, 'search'
])->name('docs.search')->middleware('throttle:60,1');
