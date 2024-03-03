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

        if (isset($_GET['search']) && !empty($_GET['search']))
            $filters['search'] = $_GET['search'];

        if (isset($_GET['type']) && !empty($_GET['type']))
            $filters['type'] = $_GET['type'];

        $data = [
            'summaries' => $this->Summaries->getAll($filters, 10),
            'pager' => $this->Summaries->pager
        ];

        $this->viewdata['title'] = 'Lista de Sumarios';
        $this->viewdata['section'] = 'summaries-list';
        $this->viewdata['summaries'] = $data['summaries'];
        $this->viewdata['pager'] = $data['pager'];

        return view('apps/summaries', $this->viewdata);
    }

    /**
     * Show edit summary form.
     *
     * @param int $id
     * @return void
     */
    public function buildEdit($id) {

        $summary = $this->Summaries->getByid($id);
        $summaryInvolved = $this->Summaries->getInvolved($id);

        if (!$summary)
            show_404();

        $this->viewdata['title'] = 'Sumario';
        $this->viewdata['section'] = 'summaries-form';
        $this->viewdata['summary'] = $summary;
        $this->viewdata['summaryInvolved'] = $summaryInvolved;

        return view('apps/summaries-form', $this->viewdata);
    }
}
