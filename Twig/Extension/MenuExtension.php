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
use Glory\Bundle\MenuBundle\Model\MenuManager;

/**
 * Description of Menu
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuExtension extends \Twig_Extension
{

    protected $helper;
    protected $menuManager;

    public function __construct(Helper $helper, MenuManager $menuManager)
    {
        $this->helper = $helper;
        $this->menuManager = $menuManager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('menu_roots', array($this, 'getRoots')),
            new \Twig_SimpleFunction('menu_get', array($this, 'get')),
            new \Twig_SimpleFunction('menu_render', array($this, 'render'), array('is_safe' => array('html'))),
        );
    }

    public function getRoots()
    {
        return $this->menuManager->findMenus();
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
        if (empty($options['template'])) {
            $options['template'] = $menu->getTemplate() ? : 'GloryMenuBundle:Menu:menu.html.twig';
        }
        return $this->helper->render($menu, $options, $renderer);
    }

    public function getName()
    {
        return 'glory_menu.menu';
    }

}
