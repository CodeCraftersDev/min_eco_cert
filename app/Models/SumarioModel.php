<?php
namespace App\Models;
use CodeIgniter\Model;

class SumarioModel extends Model{

    protected $sumario = 'sumarios';
    protected $sumarioDet = 'sumarios_detalle';
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
                    'created' => time(),
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
                    'created' => time(),
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

                $selectBuilder = $this->db->table('sumarios su');
                $query = $selectBuilder->select('su.id, su.d_sumario, det.d_destino, det.d_estado_multa, det.d_observacion')
                    ->join('sumarios_detalle det', 'su.id = det.sumarios_id')
                    ->whereIn('su.id', $ids)
                    ->get();

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
                        'created' => time(),
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
     * Get summary from database by ID.
     *
     * @param int $id
     * @return array
     */
    public function getById ($id) {
        try {

            $builder = $this->db->table($this->sumario.' s');
            $query =  $builder->select('s.id, s.d_sumario, s.f_entrada, s.n_expte, s.f_inicio_expte,  sd.*')
                ->join($this->sumarioDet.' sd', 's.id = sd.sumarios_id')
                ->where('s.id', $id)
                ->get();

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

            // TODO: add filters!
            //  if(is_array($filter) && !empty($filter)) {
            //      if(isset($filter['search']) && !empty($filter['search'])) {
            //          if($filter['type'] === 'name')
            //              $query->like('st.denominacion', $filter['search']);
            //          else
            //              $query->where('s.id', $filter['search']);
            //      }
            //  }

            $pager = service('pager');
            $offset = ($page - 1) * $perPage;

            $builder = $this->db->table($this->sumario.' s');
            $query = $builder->select('s.id, s.d_sumario, sd.d_disposicion, sd.d_origen, sd.d_destino')
                ->join($this->sumarioDet.' sd', 's.id = sd.sumarios_id')
                ->get($perPage,$offset)
                ->getResult();

            $total = $builder->countAllResults(); // Obtener el total de resultados

            $pager = $pager->makeLinks($page,$perPage,$total);

            return [
                'summaries' => $query,
                'pager' => $pager
            ];
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
