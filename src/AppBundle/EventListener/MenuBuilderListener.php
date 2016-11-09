<?php
namespace AppBundle\EventListener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class MenuBuilderListener
{
    public function addFrontendMenuItems (MenuBuilderEvent $event){
        $menu = $event->getMenu();
        $menu->addChild('kingsley')
            ->setLabel('Kingsley Menu');
    }
}