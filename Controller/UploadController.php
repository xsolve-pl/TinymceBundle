<?php

namespace Stfalcon\Bundle\TinymceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Stfalcon\Bundle\TinymceBundle\Form\Type\ImageType;
use Stfalcon\Bundle\TinymceBundle\Model\Image;

class UploadController extends Controller
{
    public function dialogAction()
    {
        $image = new Image();
        $form = $this->createForm(new ImageType(), $image);
        
        return $this->render('StfalconTinymceBundle:Upload:dialog.html.twig',array(
            'form' => $form->createView()
        ));
    }
    
    public function uploadAction()
    {
        $image = new Image();
        $form = $this->createForm(new ImageType(), $image);
        
        $request = $this->getRequest();
        $form->bindRequest($request);
        
        if ($form->isValid()) {
            $image->setUploadRootDir($this->container->getParameter('stfalcon_tinymce.upload_directory'));
            $image->setWebPath($this->container->getParameter('stfalcon_tinymce.web_path'));
            $image->upload();
        }
        
        return $this->render('StfalconTinymceBundle:Upload:upload.html.twig', array(
            'root_path' => $request->getHttpHost(),
            'image' => $image
        ));
    }
}
