<?php

namespace Larangular\ArtisanGUI;

use Illuminate\Support\ServiceProvider;

class ArtisanGUIServiceProvider extends ServiceProvider {

    public function boot() {
        include __DIR__ . '/routes.php';
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'ArtisanGUI');
        $this->commands();
    }

}
