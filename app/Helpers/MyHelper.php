<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appconfig;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


if (!function_exists('test')) {
    function test(){
        return "test helper";
    }
}