<?php

namespace Stfalcon\Bundle\TinymceBundle\Model;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class Image
{
    protected $name;
    protected $file;
    protected $upload_dir = 'media/images';
    protected $web_dir;

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        if (null !== $this->file) {
            $this->name = $this->getFilename();
            
            try {
                $this->file->move($this->getUploadRootDir(), $this->name);
            }
            catch (FileException $e) {
                //@TODO
                throw $e;
            }
            unset($this->file);
        }
        
    }

    public function getName()
    {
        return $this->name;
    }

    protected function getFilename()
    {
        $name = '';
        do
        {
            $name = uniqid().'.'.$this->file->guessExtension();
        } while (file_exists($name));

        return $name;
    }

    protected function getUploadRootDir()
    {
        return $this->upload_dir;
    }

    public function setUploadRootDir($path)
    {
        if (!file_exists($path) || !is_dir($path)) {
            throw new \InvalidArgumentException(sprintf('Directory %s does not exists', $path));
        }
        $this->upload_dir = $path;
    }

    public function getWebPath()
    {
        return $this->web_dir;
    }

    public function setWebPath($path)
    {
        $this->web_dir = $path;
    }
}
