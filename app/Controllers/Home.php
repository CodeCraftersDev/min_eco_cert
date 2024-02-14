<?php

namespace App\Controllers;

use App\Models\TestModel;

class Home extends BaseController
{
    public function index(): string {
        /*$data = array(
            'lorem' => 'ipsum',
            'changos' => 'locos'
        );
        pre($data);*/
        $model = new TestModel();
        $result = $model->getTest();
        return view('welcome_message', $result);
    }
}
