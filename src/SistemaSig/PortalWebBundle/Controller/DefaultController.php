<?php

namespace SistemaSig\PortalWebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'SistemaSigPortalWebBundle:Default:index.html.twig',
            array(
                //'name' => $name
            )
        );
    }
}
