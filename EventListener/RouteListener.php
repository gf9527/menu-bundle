<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Glory\Bundle\MenuBundle\Model\MenuInterface;

/**
 * Description of RouteListener
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class RouteListener implements EventSubscriber
{

    public function getSubscribedEvents()
    {
        return [
            Events::postLoad
        ];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        return $this->updateRoute($args);
    }

    protected function updateRoute(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof MenuInterface) {
            
        }
    }

}
