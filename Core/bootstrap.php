<?php

use Core\App;
use Core\Auth;

App::set('config', require 'config.php');


if (App::get('config')['error_handling']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL & ~E_DEPRECATED);
}

Auth::ensureSessionStarted();

