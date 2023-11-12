<?php

namespace App\Controllers;

use App\Models\Task;
use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;

class HomeController {
    public function show() {
        return view('index');
    }
}