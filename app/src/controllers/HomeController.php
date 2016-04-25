<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class HomeController extends BaseController
{
    public function home(Request $request, Response $response, $args)
    {
        $this->view->render($response, 'home.twig');
        return $response;
    }

}
