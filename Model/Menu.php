<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Model;

use Knp\Menu\MenuItem;

/**
 * Description of Menu
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Menu extends MenuItem implements MenuInterface
{

    /**
     * id
     */
    protected $id;

    /**
     * 是否展开
     * @var boolean 
     */
    protected $expand = true;
    protected $weight;

    public function __construct($name = null)
    {
        if ($name) {
            $this->name = (string) $name;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setExpand($expand)
    {
        $this->expand = $expand;
        return $this;
    }

    public function getExpand()
    {
        return $this->expand;
    }

    public function getDisplay()
    {
        return $this->display;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

}
