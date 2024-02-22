<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AjaxFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!$request->isAJAX()) {
            // Redirect or handle the non-AJAX request as needed
            return redirect()->to('Guest/index');
        }

        return $request;
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}