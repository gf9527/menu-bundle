<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Model;

use Knp\Menu\ItemInterface;

/**
 * MenuInterface
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
interface MenuInterface extends ItemInterface
{

    public function getTreeName();

    public function setIcon($icon);

    public function getIcon();

    public function setTemplate($template);

    public function getTemplate();

    public function setWeight($weight);

    public function getWeight();
}
