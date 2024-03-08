<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null){
        if(!url_is('/admin/login')){
            if (!session()->get('logged_in')){
                return redirect()->to('/admin');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}