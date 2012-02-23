<?php

namespace Stfalcon\Bundle\TinymceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('file', 'file');
    }

    public function getName()
    {
        return 'tinymce_image_upload';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Stfalcon\Bundle\TinymceBundle\Model\Image',
        );
    }
}

