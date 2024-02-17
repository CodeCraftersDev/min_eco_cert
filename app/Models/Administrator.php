<?php
namespace App\Models;
use CodeIgniter\Model;

class Administrator extends Model {

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /**
     * Check user logged.
     *
     * @return bool
     */
    public function isLogged() {
        return session('logged_in');
    }
}
