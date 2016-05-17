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
use Glory\Bundle\MenuBundle\Model\MenuManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Glory\Bundle\MenuBundle\Model\MenuInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Description of MenuType
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuType extends AbstractType
{

    /**
     * @var MenuManager 
     */
    protected $menuManager;

    public function __construct(MenuManager $menuManager)
    {
        $this->menuManager = $menuManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
                ->add('name', null, array('label' => 'form.menu_name', 'translation_domain' => 'GloryMenuBundle'))
                ->add('label', null, array('label' => 'form.menu_label', 'translation_domain' => 'GloryMenuBundle'))
                ->add('uri', null, array('label' => 'form.menu_uri', 'translation_domain' => 'GloryMenuBundle'))
                ->add('attributes', 'glory_menu_attributes', array(
                    'label' => 'form.menu_attributes',
                    'translation_domain' => 'GloryMenuBundle'
                ))
                ->add('linkAttributes', 'glory_menu_link', array(
                    'label' => 'form.menu_linkAttributes',
                    'translation_domain' => 'GloryMenuBundle'
                ))
                ->add('display', 'checkbox', array(
                    'value' => true,
                    'label' => 'form.menu_display',
                    'translation_domain' => 'GloryMenuBundle'
                ))
                ->add('expand', 'checkbox', array(
                    'value' => true,
                    'label' => 'form.menu_expand',
                    'translation_domain' => 'GloryMenuBundle'
                ))
                ->add('parent', 'entity', array(
                    'class' => $this->menuManager->getClass(), //'AppBundle:Menu',
                    'property' => 'label',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('m')
                                ->where('m.parent is null')
                                ->orderBy('m.name', 'desc');
                    },
                    'label' => 'form.menu_parent',
                    'translation_domain' => 'GloryMenuBundle'
                ))
                ->add('weight', 'integer', array(
                    'label' => 'form.menu_weight',
                    'translation_domain' => 'GloryMenuBundle'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MenuInterface::class
        ));
    }

    public function getName()
    {
        return 'glory_menu';
    }

}
