<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 10/25/16
 * Time: 23:22
 */


namespace Larangular\ArtisanGUI\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class Commands {

    private $commands;

    public function __construct() {
        $this->artisanCommands();
    }

    public function artisanCommands() {
        if (!isset($this->commands)) {
            Artisan::call('list', ['--format' => 'json']);
            $response = Artisan::output();
            $this->commands = json_decode($response);
        }

        return $this->commands;
    }

    public function getCommands($namespaceId) {
        $namespace = array_where(
            $this->commands->namespaces, function ($value) use ($namespaceId) {
            return ($value->id == $namespaceId);
        }
        );

        $namespace = array_first($namespace);
        $commands = array_where(
            $this->commands->commands, function ($value) use ($namespace) {
            return (array_search($value->name, $namespace->commands) !== false);
        }
        );

        return $commands;
    }

    public function getCommand($name) {
        $command = array_where(
            $this->commands->commands, function ($value) use ($name) {
            return ($name == $value->name);
        }
        );

        return array_first($command);
    }

    public function callCommand($name, $data) {
        Artisan::call($name, $data);
        dd(Artisan::output());
    }


}
