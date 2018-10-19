<?php

namespace Larangular\ArtisanGUI\Http\Controllers;

use Larangular\ArtisanGUI\Http\Controllers\Commands;
use Illuminate\Support\Facades\Request;

class Gateway {

    private $commands;

    public function __construct() {
        $this->commands = new Commands();
    }

    public function index(Request $request) {
        $commands = $this->commands->artisanCommands();
        return view('ArtisanGUI::index', ['namespaces' => $commands->namespaces]);
    }

    public function show(Request $request, $id, $commandName = null) {
        $commands = $this->commands->artisanCommands();
        $namespaces = $commands->namespaces;
        $filteredCommands = $this->commands->getCommands($id);
        $data = [
            'id'         => $id,
            'namespaces' => $namespaces,
            'commands'   => $filteredCommands,
        ];

        if (isset($commandName)) {
            $name = $id . ':' . $commandName;
            $commandDetail = $this->commands->getCommand($name);
            $data['detail'] = $commandDetail;
        }

        return view('ArtisanGUI::index', $data);
    }

    public function call(Request $request) {
        $params = [];
        foreach (Request::all() as $key => $value) {
            if ($value !== null) {
                if ($value == 'true') {
                    $params[$key] = true;
                } else {
                    $params[$key] = $value;
                }
            }
        }

        $name = $params['command_name'];
        unset($params['command_name']);

        $this->commands->callCommand($name, $params);
    }


}
