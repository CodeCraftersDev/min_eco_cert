<?php

namespace App\Controllers;

use App\Models\SumarioModel;

class Home extends BaseController
{
    public function index(){
        return view('home_page');
    }

    public function validatedni(){
        try{
            $resp = array();
            $dni = $this->request->getPost('dni');

            $model = new SumarioModel();
            $arr = $model->searchSumaryByDNI($dni);
            if(count($arr) == 0){/** no se encontro dni mandarlo a no registrado */
                $resp = [
                    'message' => 'No se ha encontrado registrado su DNI en Sumarios',
                    'url' => base_url('certificado'),
                    'resultado' => 'OK'
                ];
            }
            else{
                $resp = [
                    'ids'
                    'message' => 'Se ha encontrado registrado su DNI en Sumarios',
                    'url' => base_url('certificadoregistra'),
                    'resultado' => 'OK'
                ];
            }
            return $this->response->setJSON($arr)->setStatusCode(200);
        }
        catch (\Exception $e) {
            $resp = [
                'message' => html_entity_decode($e->getMessage()),
                'resultado' => 'NOOK'
            ];
            return $this->response->setJSON($resp)->setStatusCode(409);
        }
    }

}
