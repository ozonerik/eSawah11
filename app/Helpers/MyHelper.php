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

if (!function_exists('url_copyright')) {
    function url_copyright(){
        return '/';
    }
}

if (!function_exists('get_copyright')) {
    function get_copyright(){
        return 'esawah.my.id';
    }
}

if (!function_exists('get_googleapikey')) {
    function get_googleapikey(){
        //return 'AIzaSyC4n0qKTgofSQtwYANwBrNd5lO-_mFUwt4';
        $mapapi=Appconfig::find(1)->mapapikey;
        return $mapapi;
    }
}

if (!function_exists('cek_currentroute')) {
    function cek_currentroute($routelist){
        $current_route = Route::currentRouteName();
        $cek = in_array($current_route,$routelist);
        return $cek;
    }
}

if (!function_exists('get_version')) {
    function get_version(){
        return 'v11';
    }
}