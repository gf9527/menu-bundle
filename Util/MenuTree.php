<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Util;

use Glory\Bundle\MenuBundle\Model\MenuInterface;

/**
 * Description of MenuTree
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuTree
{

    public function generate(MenuInterface $menu, $incSelf = true)
    {
        $tree = array();
        if ($incSelf) {
            $tree[$menu->getName()] = $menu;
        }
        if ($menu->hasChildren()) {
            $children = $menu->getChildren();
            uasort($children, function(MenuInterface $a, MenuInterface $b) {
                if ($a->getWeight() == $b->getWeight()) {
                    return 0;
                }
                return ($a->getWeight() < $b->getWeight()) ? 1 : -1;
            });
            foreach ($children as $child) {
                $tree = array_merge($tree, [$child->getName() => $child], $this->generate($child, false));
            }
        }
        return $tree;
    }

}
