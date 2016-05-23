<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Glory\Bundle\MenuBundle\Model\MenuInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Menu AdminController
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class AdminController extends Controller
{

    public function listAction()
    {
        $menuManager = $this->get('glory_menu.menu_manager');
        $rootMenus = $menuManager->findMenus(['parent' => null]);
        return $this->render('GloryMenuBundle:Admin:list.html.twig', array(
                    'menus' => $rootMenus
        ));
    }

    public function createAction(Request $request)
    {
        $menuManager = $this->get('glory_menu.menu_manager');
        $menu = $menuManager->createMenu();

        $form = $this->createForm('glory_menu_form', $menu, ['type' => 'root']);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $menuManager->updateMenu($menu);
            return $this->redirectToRoute('glory_menu');
        }
        return $this->render('GloryMenuBundle:Admin:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function showAction(Request $request, $id)
    {
        $menu = $this->getMenuOrException($id);
        if (!$menu->isRoot()) {
            return $this->redirectToRoute('glory_menu_show', ['id' => $menu->getRoot()->getId()]);
        }
        return $this->render('GloryMenuBundle:Admin:show.html.twig', array(
                    'menu' => $menu
        ));
    }

    public function addAction(Request $request, $id)
    {
        $menuManager = $this->get('glory_menu.menu_manager');
        $menu = $menuManager->createMenu();
        $parentMenu = $this->getMenuOrException($id);
        $menu->setParent($parentMenu);
        $form = $this->createForm('glory_menu_form', $menu);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $menuManager->updateMenu($menu);
            return $this->redirectToRoute('glory_menu_show', array('id' => $menu->getId()));
        }
        return $this->render('GloryMenuBundle:Admin:add.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $id
        ));
    }

    public function editAction(Request $request, $name)
    {
        $menu = $this->getMenuOrException($name);
        return $this->render('GloryMenuBundle:Admin:edit.html.twig', array(
                        // ...
        ));
    }

    public function deleteAction(Request $request, $name)
    {
        $menu = $this->getMenuOrException($name);
        return $this->redirectToRoute('glory_menu_show', ['name' => $name]);
    }

    /**
     * 
     * @param type $name
     * @return MenuInterface
     * @throws NotFoundHttpException
     */
    protected function getMenuOrException($id)
    {
        $menu = $this->get('glory_menu.menu_manager')->findMenu($id);
        if (!$menu) {
            throw $this->createNotFoundException(sprintf('%s menu is not exist.', $id));
        }
        return $menu;
    }

}
