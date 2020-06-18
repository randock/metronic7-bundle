<?php

declare(strict_types=1);

namespace Randock\Metronic7Bundle\Menu;

use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder5 extends MenuBuilder
{
    public const TOGGLE_CLICK = 'click';
    public const TOGGLE_HOVER = 'hover';

    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack): ItemInterface
    {
        $menu = $this->factory->createItem('mainmenu');
        $menu->setChildrenAttribute('class', 'm-menu__nav  m-menu__nav--submenu-arrow');
        $this->loadServices($menu, $this->factory, self::MAIN_MENU);
        $this->addSubmenu($menu);

        $this->reorderMenuItems($menu);

        return $menu;
    }

    /**
     * @param ItemInterface $item
     * @param string        $submenutoggle
     */
    public function addSubmenu(ItemInterface $item, string $submenutoggle = self::TOGGLE_CLICK): void
    {
        foreach ($item as $child) {
            $child->setAttribute('aria-haspopup', 'true');
            $child->setAttribute('class', 'm-menu__item');

            if ($child->hasChildren()) {
                $child->setChildrenAttribute('class', 'm-menu__subnav');
                $child->setLinkAttribute('class', 'm-menu__link m-menu__toggle');
                $child->setAttribute('class', 'm-menu__item m-menu__item--submenu m-menu__item--rel');
                $child->setAttribute('m-menu-submenu-toggle', $submenutoggle);
                $child->setAttribute('aria-haspopup', 'true');
                $this->addSubmenu($child, self::TOGGLE_HOVER);
            } else {
                $child->setLinkAttribute('class', 'm-menu__item m-menu__link');
            }
        }
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     */
    public function createTopMenu(RequestStack $requestStack): ItemInterface
    {
        $menu = $this->factory->createItem('topmenu');
        $menu->setChildrenAttribute('class', 'm-nav m-nav--skin-light');
        $this->loadServices($menu, $this->factory, self::TOP_MENU);
        $this->setTopMenuItemsClasses($menu);

        $this->reorderMenuItems($menu);

        return $menu;
    }

    public function setTopMenuItemsClasses(ItemInterface $item): void
    {
        /** @var ItemInterface $child */
        foreach ($item as $child) {
            if (null === $child->getLinkAttribute('class')) {
                $child->setLinkAttribute('class', 'm-nav__link');
            }
        }
    }
}
