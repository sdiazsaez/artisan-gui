<?php

Route::group(
    [
        'namespace' => '\Larangular\ArtisanGUI\Http\Controllers',
        'prefix'    => config('artisan-gui.route-prefix'),
    ], function () {

    Route::get('/', 'Gateway@index');
    Route::get('{namespace}/{command?}', 'Gateway@show');
    Route::post('/call', 'Gateway@call');

}
);
