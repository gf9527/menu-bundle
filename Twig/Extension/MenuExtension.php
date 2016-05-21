<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
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
            new \Twig_SimpleFunction('menu_render', array($this, 'render')),
        );
    }

    public function render($name, $options = [])
    {
        $menu = $this->helper->get($name, [], $options);
        $renderer = $menu->getTemplate();
        return $this->helper->render($menu, $options, $renderer);
    }

    public function getName()
    {
        return 'glory_menu.menu';
    }

}
