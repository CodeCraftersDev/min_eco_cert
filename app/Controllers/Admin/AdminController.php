<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController {

    protected $Administrator;

    public function __construct() {
        $this->Administrator = new \App\Models\Administrator();
        $this->db = \Config\Database::connect();
    }

    /**
     * Process index
     *
     * @return void
     */
    public function index() {
        if ($this->Administrator->isLogged())
            return $this->_buildDash();
        else
            return $this->_buildLogin();
    }

    /**
     * Show login page.
     *
     * @return void
     */
    private function _buildLogin() {
        $this->viewdata['title'] = 'Min. Ecología Login';
        $this->viewdata['section'] = 'admin-login';
        return view('admin/login', $this->viewdata);
    }

    /**
     * Build dashboard page.
     *
     * @return void
     */
    private function _buildDash() {
        $this->viewdata['title'] = 'Admin';
        $this->viewdata['section'] = 'Home';
        return view('admin/index', $this->viewdata);
    }

    /**
     * Process login function
     *
     * @return object
     */
    public function login(): object {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // Verificar usuario en la BD
        try{
            $builder = $this->db->table('users');
            $query = $builder->select()->where('username',$username)->get();
            $user = $query->getResultArray();
            $user = $user ? $user[0] : false;
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            throw new \RuntimeException($e->getMessage());
        }

        if($user) {
            if($this->verifyPass($username, $password)) {
                session()->set('logged_in', true);
                session()->set('userid', $user['id']);
                session()->set('username',  $user['username']);
                session()->set('name',  $user['name']);
                $data = [ 'action' => true ];
            } else
                $data = [ 'action' => false, 'msg' => 'Credenciales incorrectas' ];
        } else
            $data = [ 'action' => false, 'msg' => 'Usuario inexistente' ];

        return $this->response->setJSON($data);
    }

    /**
     * Check correct pass for user.
     *
     * @param string $username
     * @return bool
     */
    private function verifyPass(string $username, $password ): bool {

        $pw = base64_decode($password);

        try{
            $builder = $this->db->table('users');
            $query = $builder->select()
                ->where('username',$username)
                ->where('password',sha1($pw))
                ->get();
            $user = $query->getResultArray();
            return (bool)$user;
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Logout: Process logout and redirect to login page.
     *
     * @return void
     */
    public function logout() {
        session()->remove('logged_in');
        session()->remove('userid');
        session()->remove('username');
        session()->remove('name');
        session()->destroy();
        return redirect()->route('admin');
    }
}
