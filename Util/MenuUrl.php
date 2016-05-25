<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Util;

use Glory\Bundle\MenuBundle\Model\MenuInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Description of MenuUri
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuUrl
{

    protected $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function generate(MenuInterface $menu)
    {
        if ($route = $menu->getRoute()) {
            list($name, $parameters) = $route;
            return $this->router->generate($name, $parameters);
        }
        return $menu->getUri();
    }

}
