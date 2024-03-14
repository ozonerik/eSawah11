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

if (!function_exists('get_floatttorp')) {
    function get_floatttorp($val){
        $val = floatval($val);
        $a = new NumberFormatter("id-ID", NumberFormatter::CURRENCY);
        $a->setAttribute( $a::FRACTION_DIGITS, 0 );
        $result=$a->formatCurrency($val,"IDR");
        return $result;
    }
}

if (!function_exists('get_hargapadi')) {
    function get_hargapadi(){
        //$harga=750000;
        $harga=Appconfig::find(1)->hargapadi;
        return $harga;
    }
}

if (!function_exists('get_nilailanja')) {
    function get_nilailanja(){
        //$lanja=5;
        $lanja=Appconfig::find(1)->nilailanja;
        return $lanja;
    }
}

if (!function_exists('get_lanja')) {
    function get_lanja($meter,$kw){
        $a = new NumberFormatter("id-ID", NumberFormatter::DECIMAL);
        $kw=intval($kw);
        $bata=floatval($meter)/14.00;
        $lanja=$bata/100;
        $val=round($lanja*$kw,2);
        $nlanjakw=$a->format($val);
        $lanjatext=$nlanjakw." kw";
        return $lanjatext;
    }
}

if (!function_exists('get_nlanja')) {
    function get_nlanja($meter,$kw,$harga){
        $kw=intval($kw);
        $harga=intval($harga);
        $bata=floatval($meter)/14.00;
        $lanja=$bata/100;
        $nlanjarp=round($lanja*$kw,2)*$harga;
        $nlanjatext=get_floatttorp($nlanjarp);
        return $nlanjatext;
    }
}