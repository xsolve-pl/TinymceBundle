<?php

namespace Stfalcon\Bundle\TinymceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ScriptController extends Controller
{
    public function setupAction()
    {
        return $this->render('StfalconTinymceBundle:Script:setup.js.twig');
    }
}
