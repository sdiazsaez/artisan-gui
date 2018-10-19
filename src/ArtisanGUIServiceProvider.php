<?php

namespace Larangular\ArtisanGUI;

use Illuminate\Support\ServiceProvider;

class ArtisanGUIServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/Routes/ArtisanGUIRoute.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'ArtisanGUI');
        $this->commands();
    }

}
