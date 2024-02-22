<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session=session();
        if(!$session->has('user'))
            return redirect()->to(site_url('Guest/index'));
        else{
            $user = $session->get('user');
            if($user->isAdmin){
                return redirect()->to(site_url('Admin/index'));
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}