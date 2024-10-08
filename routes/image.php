<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Enums\GroupConfigKey;
use App\Enums\ConfigKey;

$extensions = config('convention.group.accepted_file_suffixes');
Route::group([], function () use ($extensions) {
    $extensions = array_merge(array_map('strtoupper', $extensions), array_map('strtolower', $extensions));
    Route::any('{key}.{extension}', [
        Controller::class, 'output',
    ])->where("key", "^(?!thumbnails$).*")->where('extension', implode('|', $extensions));
});
