<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Glory\Bundle\MenuBundle\Model\Menu as BaseMenu;

/**
 * Menu Entity
 * 
 * @ORM\MappedSuperclass
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Menu extends BaseMenu
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Name unique
     *
     * @ORM\Column(name="name", type="string", unique=true)
     */
    protected $name = null;

    /**
     * Label text
     *
     * @ORM\Column(name="label", type="string", nullable=true)
     */
    protected $label = null;

    /**
     * Uri
     *
     * @ORM\Column(name="uri", type="string", nullable=true)
     */
    protected $uri = null;

    /**
     * Weight
     *
     * @ORM\Column(name="weight", type="integer")
     */
    protected $weight = 0;

    /**
     * display
     *
     * @ORM\Column(name="display", type="boolean")
     */
    protected $display = true;

    /**
     * expand children
     *
     * @ORM\Column(name="expand", type="boolean")
     */
    protected $expand = true;

    /**
     * Child items
     *
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="parent", cascade={"all"})
     */
    protected $children = array();

    /**
     * Attributes
     *
     * @ORM\Column(type="array")
     */
    protected $attributes = array();

    /**
     * link Attributes
     *
     * @ORM\Column(name="link_attrs", type="array")
     */
    protected $linkAttributes = array();

    /**
     * Children Attributes
     *
     * @ORM\Column(name="children_attrs", type="array")
     */
    protected $childrenAttributes = array();

    /**
     * Parent item
     *
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $parent = null;

}
