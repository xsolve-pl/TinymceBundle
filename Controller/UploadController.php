<?php

namespace Stfalcon\Bundle\TinymceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Stfalcon\Bundle\TinymceBundle\Form\UploadType;
use Stfalcon\Bundle\TinymceBundle\Form\Model\Image;

class UploadController extends Controller
{
    public function dialogAction()
    {
        $image = new Image();
        
        $form = $this->createForm(new UploadType(),$image);
        
        return $this->render('StfalconTinymceBundle:Upload:dialog.html.twig',array(
            'form' => $form->createView()
        ));
    }
    
    public function uploadAction()
    {
        $image = new Image();
        
        $form = $this->createForm(new UploadType(),$image);
        
        $request = $this->getRequest();
        $form->bindRequest($request);
        
        if ( $form->isValid() ) {
            $image->upload();
        }
        
        return $this->render('StfalconTinymceBundle:Upload:upload.html.twig', array(
            'root_path' => $request->getHttpHost(),
            'image' => $image
        ));
    }
    
    /**
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function getUploadForm()
    {
        
    }
}
