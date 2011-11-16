<?php

namespace Stfalcon\Bundle\TinymceBundle\Form\Model;

use Symfony\Component\HttpFoundation\File\Exception\FileException;


class Image
{
    public $name;
    /**
     *
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile $file
     */
    public $file;
    
    public function upload()
    {
        if (null !== $this->file) {
            $this->name = uniqid().'.'.$this->file->guessExtension();
            
            try {
                $this->file->move($this->getUploadRootDir(), $this->name);
            }
            catch ( FileException $e ) {
                echo $e->getMessage();exit('FileException');
            }
            unset($this->file);
        }
        
    }
    
    public function getAbsolutePath()
    {
        return null === $this->name ? null : $this->getUploadRootDir().'/'.$this->name;
    }

    public function getWebPath()
    {
        return null === $this->name ? null : $this->getUploadDir().'/'.$this->name;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'media/images';
    }
}
