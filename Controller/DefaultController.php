<?php

namespace Hygrid\JWTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HygridJWTBundle:Default:index.html.twig');
    }
}
