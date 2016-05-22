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

use Knp\Menu\MenuItem;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Description of Menu
 * 
 * @UniqueEntity("name")
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
     * name
     * 
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * attributes,linkAttributes,childrenAttributes explain
     * code
     *  <ul>
     *      <li {$attributes}>
     *          <a href="/" {$linkAttributes}>Home</a>
     *          <ul ${childrenAttributes}>
     *              <li {$child::attributes}>
     *                  <a href="#">Next</a>
     *              </li>
     *          </ul>
     *      </li>
     *  </ul>
     */
    protected $attributes = array();
    protected $linkAttributes = array();
    protected $childrenAttributes = array();

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

    public function getChildren()
    {
        $children = parent::getChildren();
        if (!is_array($children)) {
            $data = [];
            try {
                foreach ($children as $name => $child) {
                    $data[$name] = $child;
                }
            } catch (Exception $exc) {
                
            }
            $children = $data;
        }
        return $children;
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

    public function getTreeName()
    {
        $left = '　';
        $right = '└─ ';
        return str_pad($right, $this->getLevel() * strlen($left) + strlen($right), $left, STR_PAD_LEFT) . $this->getLabel();
    }

}
