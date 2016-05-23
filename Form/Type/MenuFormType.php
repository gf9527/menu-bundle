<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Glory\Bundle\MenuBundle\Model\MenuManager;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of MenuFormType
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuFormType extends AbstractType
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
        ;
        switch ($options['type']) {
            case 'root':
                $builder->add('template', null, array(
                    'label' => 'form.menu_template',
                    'translation_domain' => 'GloryMenuBundle'
                ));
                break;
            default:
                $menuRoot = $options['data']->getRoot();
                $choice = $this->generateChildrenChoice($menuRoot);
                $builder->add('uri', null, array(
                    'label' => 'form.menu_uri',
                    'translation_domain' => 'GloryMenuBundle'
                ));
                $builder->add('icon', null, array(
                    'label' => 'form.menu_icon',
                    'translation_domain' => 'GloryMenuBundle'
                ));
                $builder->add('parent', 'entity', array(
                    'class' => $this->menuManager->getClass(),
                    'property' => 'treename',
                    'choices' => $choice,
                    'label' => 'form.menu_parent',
                    'translation_domain' => 'GloryMenuBundle'
                ));
                break;
        }
    }

    protected function generateChildrenChoice($menu)
    {
        $choice = array(
            $menu->getName() => $menu//$menu->getLevel(). $menu->getLabel()
        );
        if ($menu->hasChildren()) {
            foreach ($menu->getChildren() as $item) {
                $choice = array_merge($choice, $this->generateChildrenChoice($item));
            }
        }
        return $choice;
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'type' => 'default',
        ));
        $resolver->setDefined('type');
    }

    public function getName()
    {
        return 'glory_menu_form';
    }

}
