<?php

namespace App\Controllers\Apps;

use App\Controllers\BaseController;

class SummariesController extends BaseController {

    protected $Summaries;

    public function __construct() {
        $this->Summaries = new \App\Models\SumarioModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Show main page
     *
     * @return void
     */
    public function index() {

        $filters = [];

        if (isset($_GET['name']) && !empty($_GET['name']))
            $filters['name'] = $_GET['name'];

        if (isset($_GET['id']) && !empty($_GET['id']))
            $filters['id'] = $_GET['id'];

        $data = [
            'summaries' => $this->Summaries->getAll($filters),
            'pager' => $this->Summaries->pager
        ];

        $this->viewdata['title'] = 'Lista de Sumarios';
        $this->viewdata['section'] = 'summaries-list';
        $this->viewdata['summaries'] = $data['summaries'];
        $this->viewdata['pager'] = $data['pager'];


        return view('apps/summaries', $this->viewdata);
    }
}
