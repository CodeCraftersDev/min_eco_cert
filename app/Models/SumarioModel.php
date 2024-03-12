<?php
namespace App\Models;
use CodeIgniter\Model;

class SumarioModel extends Model{

    protected $sumario = 'sumarios';
    protected $sumarioTitulares = 'sumarios_titulares';

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function searchSumaryByDNI($dni){
        try{
            $builder = $this->db->table('sumarios su');
            $query = $builder->select('su.id')
                ->join('sumarios_titulares st', 'su.id = st.sumarios_id')
                ->where('st.n_documento', $dni)
                ->get();
            return $query->getResultArray();
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function generarCertificado($nombre, $apellido, $dni, $arr, $type){
        try{
            $config         = new \Config\Encryption();
            $config->key    = 'e99a18c428cb38d5f260853678922e03';
            $config->digest = 'SHA512';
            $config->cipher = 'AES-256-CTR';
            $config->driver = 'OpenSSL';
            $encrypter = \Config\Services::encrypter($config);

            if($type == 1){/** NO REGISTRADO */
                $this->db->transStart();

                $builder = $this->db->table('certificados_cab');
                $data = [
                    'hash' => '',
                    'referencia' => $nombre.' '.$apellido.' DNI: '.$dni,
                    'created' => date('Y-m-d H:i:s'),
                    'createdby' => 'user-'.$dni
                ];
                $builder->insert($data);

                $id = $this->db->insertID();

                $hash = bin2hex($encrypter->encrypt($id));
                $builderUpdt = $this->db->table('certificados_cab');
                $builderUpdt->set('hash', $hash);
                $builderUpdt->where('id', $id);
                $builderUpdt->update();

                $this->db->transComplete();

                $query = $builder->select('hash')
                    ->where('id', $id)
                    ->get();

                return $query->getResultArray();
            }
            else{ /** REGISTRADO EN AL MENOS UN SUMARIO */
                $this->db->transStart();

                $builder = $this->db->table('certificados_cab');
                $data = [
                    'hash' => '',
                    'referencia' => $nombre.' '.$apellido.' DNI: '.$dni,
                    'created' => date('Y-m-d H:i:s'),
                    'createdby' => 'user-'.$dni
                ];
                $builder->insert($data);

                $id = $this->db->insertID();

                $hash = bin2hex($encrypter->encrypt($id));
                $builderUpdt = $this->db->table('certificados_cab');
                $builderUpdt->set('hash', $hash);
                $builderUpdt->where('id', $id);
                $builderUpdt->update();

                $this->db->transComplete();

                /** buscamos datos de sumarios */
                $ids = array();
                foreach($arr as $id_arr){
                    $ids[]=$id_arr['id'];
                }

                $selectBuilder = $this->db->table($this->sumario.' s');
                $query = $selectBuilder->whereIn('s.id', $ids)->get();

                $sumarios = $query->getResultArray();

                foreach ($sumarios as $sum){
                    $this->db->transStart();
                    $builderDet = $this->db->table('certificados_det');
                    $sumary_data = [
                        'id_cert_cab' => $id,
                        'id_sumary' => $sum['d_sumario'],
                        'ubicacion_actual' => $sum['d_destino'],
                        'estado_sumario' => ($sum['d_estado_multa'] == 'NO PAGADA')? 'En Tramite': 'Terminado',
                        'observaciones' => $sum['d_observacion'],
                        'created' => date('Y-m-d H:i:s'),
                        'createdby' => 'user-'.$dni
                    ];
                    $builderDet->insert($sumary_data);
                    $this->db->transComplete();
                }

                $builderHash = $this->db->table('certificados_cab');
                $query = $builderHash->select('hash')
                    ->where('id', $id)
                    ->get();
                return $query->getResultArray();
            }
        }
        catch(\CodeIgniter\Database\Exceptions\DatabaseException $e){
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function getCertificadoByHash($hash){
        $ret=array();
        $builder = $this->db->table('certificados_cab cab');
        $query = $builder->select('id, referencia')
            ->where('hash', $hash)
            ->get();
        $cab = $query->getResultArray();

        if(count($cab) == 0){
            $ret['cab'] = [];
            $ret['det'] = [];
        }
        else{
            $ret['cab'] = $cab[0];

            $builder = $this->db->table('certificados_det det');
            $query = $builder->select('id_sumary, ubicacion_actual, estado_sumario, observaciones')
                ->where('id_cert_cab', $ret['cab']['id'])
                ->get();
            $ret['det'] = $query->getResultArray();
        }

        return $ret;
    }
    /**
     * Funcion que crea un nuevo usuario en BLANCO en sumarios_titulares
     * @param $id
     * @return array
     */
    public function addSummary(){
        $this->db->transStart();
        $builder = $this->db->table($this->sumario.' s');
        $new = [
            'created' => date('Y-m-d H:i:s'),
            'createdby' => session()->get('username')
        ];
        $builder->insert($new);
        $id = $this->db->insertID();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            $ret = [
                'code' => 'NOOK',
                'message' => 'No se pudo insertar en la base de datos el sumario'
            ];
        }
        else{
            $ret = $id;
        }
        return $ret;
    }

    public function editSummary($summary){
        $this->db->transStart();
        $builder = $this->db->table($this->sumario.' s');
        $builder->set('f_entrada',date('Y-m-d', strtotime(str_replace('/', '-', $summary->f_entrada))));
        $builder->set('d_sumario', $summary->d_sumario);
        $builder->set('d_origen', $summary->d_origen);
        $builder->set('d_destino', $summary->d_destino);
        $builder->set('d_tramite', $summary->d_tramite);
        $builder->set('n_multa', $summary->n_multa);
        $builder->set('d_disposicion', $summary->d_disposicion);
        $builder->set('n_fojas', $summary->n_fojas);
        $builder->set('f_remision', date('Y-m-d', strtotime(str_replace('/', '-', $summary->f_remision))));
        $builder->set('d_observacion', $summary->d_observacion);
        $builder->set('updated', date('Y-m-d H:i:s'));
        $builder->set('updatedby', session()->get('username'));

        $builder->where('id', $summary->id);
        $builder->update();
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            $ret = [
                'code' => 'NOOK',
                'message' => 'No se pudo insertar en la base de datos el detalle del sumario'
            ];
        }
        else{
            $ret = [
                'summaryId' =>  $summary->id,
                'code' => 'OK',
                'message' => 'Se agregó nuevo sumario'
            ];
        }

        return $ret;
    }

    /**
     * Get summary from database by ID.
     *
     * @param int $id
     * @return array
     */
    public function getById ($id) {
        try {

            $builder = $this->db->table($this->sumario.' s');
            $query =  $builder->where('s.id', $id)->get();

            return $query->getRow();
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Get summary from database by ID.
     *
     * @param int $id
     * @return array
     */
    public function getSummaryById ($id) {
        try {

            $builder = $this->db->table($this->sumario.' s');
            $query =  $builder->where('s.id', $id)->get();

            return $query->getRow();
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Get summary involved from database by ID.
     *
     * @param int $id
     * @return array
     */
    public function getInvolved ($id) {
        try {

            $builder = $this->db->table($this->sumarioTitulares.' st');
            $query =  $builder->select('st.*')
                ->where('st.sumarios_id', $id)
                ->get();

            return $query->getResult();
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Get all data from database.
     *
     */
    public function getAll ($page, $perPage = 10, $filter = false) {
        try {
            $pager = service('pager');
            $offset = ($page - 1) * $perPage;
            $total = $this->getAllCount(true, $filter, $perPage, $offset);
            $query = $this->getAllCount(false, $filter, $perPage, $offset);
            $pager = $pager->makeLinks($page,$perPage,$total);
            return [
                'summaries' => $query,
                'pager' => $pager
            ];
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    private function getAllCount($count, $filter, $perPage, $offset){
        $builder = $this->db->table($this->sumario.' s');

        if(is_array($filter) && !empty($filter)) {
            if(isset($filter['search']) && !empty($filter['search'])) {
                if($filter['type'] === 'name') {
                    $subQuery = $this->db->table('sumarios_titulares st')->select('id')->where('st.d_denominacion', $filter['search']);
                    $builder->whereIn('s.id', $subQuery, false);
                }else
                    $builder->like('s.d_sumario', $filter['search']);
            }
        }
        // not deleted
        $builder->where('s.deleted', 'N');

        $builder->groupBy(['s.id', 's.d_sumario', 's.d_disposicion', 's.d_origen', 's.d_destino']);

        if($count == true){
            $query = $builder->countAllResults(false);
        }
        else{
            $query = $builder->get($perPage,$offset)->getResult();
        }
        return $query;
    }

    /** Funcion que trae todos los historicos del sumario que se encuentran en tabla movimientos
     * @param $id
     * @return array
     */

    public function getHistoryById($id){
        $builder = $this->db->table('movimientos su');
        $query = $builder->select('su.d_origen, su.d_destino, su.d_tramite, su.n_fojas, su.d_estado_multa as estado, su.f_remision')
            ->where('su.sumarios_id', $id)
            ->get();
        return $query->getResultArray();
    }

    /**
     * Funcion que crea un nuevo usuario en BLANCO en sumarios_titulares
     * @param $id
     * @return array
     */
    public function addNewUserSum($id){
        $this->db->transStart();
        $builder = $this->db->table('sumarios_titulares st');
        $data = [
            'sumarios_id' => $id,
            'n_documento' => null,
            'c_tipo' => null,
            'd_denominacion' => '',
            'c_ult_titular' => 'N',
            'created' => date('Y-m-d H:i:s'),
            'createdby' => session()->get('username')
        ];
        $builder->insert($data);
        $id = $this->db->insertID();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            $ret = [
                'code' => 'NOOK',
                'message' => 'No se pudo insertar en la base de datos el usuario'
            ];
        }
        else{
            $ret = [
                'userId' => $id,
                'code' => 'OK',
                'message' => 'Se agregó nuevo usuario'
            ];
        }
        return $ret;
    }

    /**
     * @param $id
     * @return array
     */
    public function updtUserSumary($id, $sumario_id, $doc, $tipo_doc, $denom, $titular){
        $this->db->transStart();
        $builder = $this->db->table('sumarios_titulares st');
        $builder->set('sumarios_id', $sumario_id);
        $builder->set('n_documento', $doc);
        $builder->set('c_tipo', $tipo_doc);
        $builder->set('d_denominacion', $denom);
        $builder->set('c_ult_titular', $titular);
        $builder->set('updated', date('Y-m-d H:i:s'));
        $builder->set('updatedby', session()->get('username'));
        $builder->where('id', $id);
        $builder->update();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            $ret = [
                'code' => 'NOOK',
                'message' => 'No se pudo guardar el usuario'
            ];
        }
        else{
            $ret = [
                'code' => 'OK',
                'message' => 'Se guardo al usuario correctamente'
            ];
        }
        return $ret;
    }

    public function delUserSumary($id){
        $this->db->transStart();
        $builder = $this->db->table('sumarios_titulares st');
        $builder->where('id', $id);
        $builder->delete();
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            $ret = [
                'code' => 'NOOK',
                'message' => 'No se pudo Eliminar al usuario'
            ];
        }
        else{
            $ret = [
                'code' => 'OK',
                'message' => 'Se eliminó al usuario correctamente'
            ];
        }
        return $ret;
    }

    /**
     * @param $id
     * @return array
     */
    public function markAsDeleted($id){
        $this->db->transStart();
        $builder = $this->db->table('sumarios s');
        $builder->set('deleted', 'S');
        $builder->set('updated', date('Y-m-d H:i:s'));
        $builder->set('updatedby', session()->get('username'));
        $builder->where('id', $id);
        $builder->update();
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            $ret = [
                'code' => 'NOOK',
                'message' => 'Error al eliminar el Sumario'
            ];
        }
        else{
            $ret = [
                'code' => 'OK',
                'message' => 'Sumario eliminado correctamente'
            ];
        }
        return $ret;
    }

}
