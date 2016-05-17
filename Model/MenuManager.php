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

use Symfony\Component\DependencyInjection\ContainerInterface;
use Glory\Bundle\MenuBundle\Model\MenuInterface;

/**
 * Description of MenuManager
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuManager
{

    protected $container;
    protected $class;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setClass($class)
    {
        if (!$class instanceof MenuInterface) {
            throw new \LogicException(sprintf('%s must implements %s', $class, get_class(MenuInterface)));
        }
        $this->class = $class;
        return $this;
    }

    public function getClass()
    {
        return $this->class;
    }

    /**
     * 创建菜单
     * 
     * @return MenuInterface
     */
    public function createMenu()
    {
        $class = $this->getClass();
        return new $class();
    }

    public function findOneBy($criteria)
    {
        $repository = $this->getDoctrine()->getRepository($this->getOAuthClass());
        return $repository->findOneBy($criteria);
    }

    public function findBy($criteria)
    {
        $repository = $this->getDoctrine()->getRepository($this->getOAuthClass());
        return $repository->findBy($criteria);
    }

    /**
     * 更新 MenuInterface
     * 
     * @param MenuInterface $menu
     * @param type $andFlush
     */
    public function updateMenu(MenuInterface $menu, $andFlush = true)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($menu);
        if ($andFlush) {
            $em->flush();
        }
    }

    /**
     * 删除 MenuInterface
     * 
     * @param MenuInterface $menu
     */
    public function deleteMenu(MenuInterface $menu)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($menu);
        $em->flush();
    }

    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return Registry
     *
     * @throws \LogicException If DoctrineBundle is not available
     */
    protected function getDoctrine()
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return $this->container->get('doctrine');
    }

}
