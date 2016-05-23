<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Twig\Extension;

use Knp\Menu\Twig\Helper;

/**
 * Description of Menu
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuExtension extends \Twig_Extension
{

    private $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('menu_get', array($this, 'get')),
            new \Twig_SimpleFunction('menu_render', array($this, 'render'), array('is_safe' => array('html'))),
        );
    }

    /**
     * get menu by name
     * 
     * @return ItemInterface
     */
    public function get($menu, array $options = array())
    {
        return $this->helper->get($menu, [], $options);
    }

    /**
     * 
     * @param type $name
     * @param type $options
     * @return string
     */
    public function render($name, $options = [], $renderer = null)
    {
        $menu = $this->helper->get($name, [], $options);
        if (empty($options['template']) && $template = $menu->getTemplate()) {
            $options['template'] = $template;
        }
        return $this->helper->render($menu, $options, $renderer);
    }

    public function getName()
    {
        return 'glory_menu.menu';
    }

}
