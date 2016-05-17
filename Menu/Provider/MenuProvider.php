<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Menu\Provider;

use Knp\Menu\Provider\MenuProviderInterface;
use Glory\Bundle\MenuBundle\Model\MenuManager;
use Glory\Bundle\MenuBundle\Model\MenuInterface;

/**
 * MenuProvider, get menu from database
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuProvider implements MenuProviderInterface
{

    /**
     * @var MenuManager
     */
    protected $menuManager;

    /**
     * 
     * @param MenuManager $menuManager
     */
    public function __construct(MenuManager $menuManager)
    {
        $this->menuManager = $menuManager;
    }

    /**
     * Retrieves a menu by its name
     *
     * @param string $name
     * @param array $options
     * @return MenuInterface
     */
    public function get($name, array $options = array())
    {
        if ($name === null) {
            throw new \InvalidArgumentException(sprintf('The menu "%s" is not defined.', $name));
        }
        $menu = $this->menuManager->findMenuByName($name);
        if ($menu) {
            return $menu;
        }
    }

    /**
     * Checks whether a menu exists in this provider
     * 
     * @param string $name
     * @param array $options
     * @return bool
     */
    public function has($name, array $options = array())
    {
        return $this->menuManager->findMenuByName($name) ? true : false;
    }

}
