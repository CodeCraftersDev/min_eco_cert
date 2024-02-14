<?php
namespace App\Models;
use CodeIgniter\Model;

class TestModel extends Model{

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getTest(){
        try{
            $builder = $this->db->table('test');
            $query = $builder->get();
            return $query->getResultArray();
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            throw new \RuntimeException($e->getMessage());
        }
    }

}