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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of MenuType
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class LinkType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
                ->add('target', ChoiceType::class, array(
                    'choices' => array(
                        '' => 'Default (Current Window)',
                        '_blank' => 'New Window',
                        '_parent' => 'Parent Window',
                        'iframe' => 'iFrame'
                    ),
                    'required' => false
                ))
                ->add('class', TextType::class, array(
                    'label' => 'Class',
                    'required' => false
                ))
                ->add('id', null, array(
                    'label' => 'Id',
                    'required' => false
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
        return 'glory_menu_link';
    }

}
