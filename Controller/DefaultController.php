<?php

namespace Glory\Bundle\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GloryMenuBundle:Default:index.html.twig');
    }
}
