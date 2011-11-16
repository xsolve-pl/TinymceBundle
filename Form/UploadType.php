<?php

namespace Stfalcon\Bundle\TinymceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('file','file');
    }

    public function getName()
    {
        return 'mce_file_upload';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Stfalcon\Bundle\TinymceBundle\Form\Model\Image',
        );
    }
}

