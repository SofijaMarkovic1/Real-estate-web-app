<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GuestFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session=session();
        if($session->has('user'))
            return redirect()->to(site_url('Login/index'));
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}