<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsCustomerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        $session = session();
        if ($session->loggedin != "yes") {
            return redirect()->to(base_url("login"));
        }

        if ($session->role != "customer") {
            $alertScript = "<script>alert('Access Restricted. You must be logged in as an agency.');</script>";
            echo $alertScript;
            return redirect()->to(base_url());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
