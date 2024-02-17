<?php

namespace App\Controllers;

use App\Models\TestModel;

class Home extends BaseController
{
    public function index(): string {
        return view('home_page');
    }
}
