<?php

namespace App\Controllers\Apps;

use App\Controllers\BaseController;

class SummariesController extends BaseController {

    protected $Summaries;
    protected $perPage;

    public function __construct() {
        $this->perPage = 10;
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

        $pager=service('pager');
        $page = (int)($this->request->getVar('page') !== null ? $this->request->getVar('page') : 1); // Obtener la página actual

        $data = [
            'summaries' => $this->Summaries->getAll($filters, $page, $this->perPage),
            'pager' => $pager
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

    /**
     * Process edit summary form.
     *
     * @return void
     */
    public function processEdit() {

        $id = $this->request->getPost('id');

        pre($id);

        $involved = $this->Summaries->getInvolved($id);

        if (!$id || !$involved)
            $this->response->setStatusCode(404, 'Not found.');


        $this->load->helper(array('form', 'url'));

        // Validations
        $this->form_validation->set_rules('url', 'Nombre', 'required');
        $this->form_validation->set_rules('community_id', 'Municipio', 'required');

        $data = $this->input->post();
        $data['active'] = $this->input->post('active') && $this->input->post('active') == 'on' ? 1 : 0;

        // Filter allowed fields
        $fields = ['url', 'community_id', 'active'];
        $data = array_filter(
            $data,
            function ($key) use ($fields) {
                return in_array($key, $fields);
            },
            ARRAY_FILTER_USE_KEY
        );

        if (!$this->form_validation->run()) {
            $this->Protect->ajaxDie(array(
                'action' => false,
                'message' => validation_errors()
            ));
        }

        $updated = $this->Websites->update($id, $data);

        if ($updated) {
            $response = array('action' => true);
            $this->session->set_flashdata('messages', array(array('type' => 'success', 'text' => 'Sitio Web <strong>' . $data['url'] . '</strong> actualizado.')));
        } else {
            $this->db->trans_rollback();
            $response = array('action' => false, 'message' => 'Ocurrió un error al intentar actualizar la base de datos.');
        }

        $this->Protect->ajaxDie($response);
    }
}
