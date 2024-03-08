<?php

namespace App\Controllers\Apps;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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
            'summaries' => $this->Summaries->getAll($page, $this->perPage, $filters),
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


    /**
     * Process delete summary || mark as deleted.
     *
     * @return ResponseInterface
     */
    public function processDelete() {

        $id = $this->request->getPost('id');

        $summary = $this->Summaries->getSummaryById($id);

        if (!$id || !$summary)
            $this->response->setStatusCode(404, 'Not found.');

        $resp = $this->Summaries->markAsDeleted($id);
        return $this->response->setJSON($resp)->setStatusCode(200);
    }

    public function getHistory(){
        $id = $this->request->getPost('id');
        $arrSumaries = $this->Summaries->getHistoryById($id);
        return $this->response->setJSON($arrSumaries)->setStatusCode(200);
    }

    public function ABMUserSumary($type){
        switch ($type) {
            case 'add':
                $sumary_id = $this->request->getPost('id');
                $resp = $this->Summaries->addNewUserSum($sumary_id);
                break;
            case 'updt':
                $id = $this->request->getPost('id');
                $sumario_id = $this->request->getPost('sumario_id');
                $doc = $this->request->getPost('documento');
                $tipo_doc = $this->request->getPost('tipo_doc');
                $denom = $this->request->getPost('denominacion');
                $titular = $this->request->getPost('titular');
                $resp = $this->Summaries->updtUserSumary($id, $sumario_id, $doc, $tipo_doc, $denom, $titular);
                break;
            case 'del':
                $user_id = $this->request->getPost('id');
                $resp = $this->Summaries->delUserSumary($user_id);
                break;
        }
        return $this->response->setJSON($resp)->setStatusCode(200);
    }
}
