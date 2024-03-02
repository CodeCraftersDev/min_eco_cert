<?php
namespace App\Models;
use CodeIgniter\Model;

class SumarioModel extends Model{

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function searchSumaryByDNI($dni){
        try{
            $builder = $this->db->table('sumarios su');
            $query = $builder->select('su.id')
                ->join('sumarios_titulares st', 'su.id = st.sumarios_id')
                ->where('st.documento', $dni)
                ->get();
            return $query->getResultArray();
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function generarCertificado($dni, $arr, $type){
        try{
            $config         = new \Config\Encryption();
            $config->key    = 'e99a18c428cb38d5f260853678922e03';
            $config->digest = 'SHA512';
            $config->cipher = 'AES-256-CTR';
            $config->driver = 'OpenSSL';
            $encrypter = \Config\Services::encrypter($config);

            if($type == true){/** NO REGISTRADO */
                $this->db->transStart();

                $builder = $this->db->table('certificados_cab');
                $data = [
                    'hash' => '',
                    'referencia' => 'REF: SOLICITUD ANTECEDENTES SUMARIOS. DNI: '.$dni,
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
                /** $encrypter = \Config\Services::encrypter();
                $plainText  = '';
                $ciphertext = $encrypter->encrypt($plainText);*/
                /*$selectBuilder = $this->db->table('sumarios su');
                $query = $selectBuilder->select('su.id')
                    ->whereIn('su.id', $arr)
                    ->get();
                $sumarios = $query->getResultArray();*/

                /*$this->db->transStart();

                $builder = $this->db->table('certificados_cab');

                $data = [
                    'id' => $n_id_mail,
                    'hash' => $remitente,
                    'referencia' => $asunto,
                    'created' => $html_mail,
                    'createdby' => $reenviar
                ];

                $builder->insert($data);

                $this->db->transComplete();*/
                return 0;
            }
        }
        catch(\CodeIgniter\Database\Exceptions\DatabaseException $e){
            throw new \RuntimeException($e->getMessage());
        }
    }

}