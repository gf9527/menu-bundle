<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Glory\Bundle\MenuBundle\Model\MenuInterface;

/**
 * Description of GetMenuEvent
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class GetMenuEvent extends Event
{

    private $menu;

    /**
     * @param MenuInterface $menu
     */
    public function __construct(MenuInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return MenuInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }

}
