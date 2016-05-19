<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of MenuType
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class AttributesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
                ->add('class', null, array(
                    'required' => false,
                    'label' => 'form.class',
                    'translation_domain' => 'GloryMenuBundle'
                ))
                ->add('id', null, array(
                    'required' => false,
                    'label' => 'form.id',
                    'translation_domain' => 'GloryMenuBundle'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        
    }

    public function getName()
    {
        return 'glory_menu_attributes';
    }

}
