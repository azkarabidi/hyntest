<?php

use Hyn\Tenancy\Models\Website;
use Illuminate\Support\Facades\Route;
use Hyn\Tenancy\Repositories\WebsiteRepository;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    $website   = \Hyn\Tenancy\Facades\TenancyFacade::website();
    if($website != NULL){
        dd($website);
    }
    return 'ok';
});



Route::get('create',function(){
    $website = new Website;
    // Implement custom random hash using Laravels Str::random
    $website->uuid = 'azkar';
    app(WebsiteRepository::class)->create($website);
    dd($website->uuid); 
});

Route::get('host',function(){

    $website = Website::find(1);
$hostname = new Hostname;
$hostname->fqdn = 'azkar.hyn-tenant.test';
$hostname = app(HostnameRepository::class)->create($hostname);
app(HostnameRepository::class)->attach($hostname, $website);
});
