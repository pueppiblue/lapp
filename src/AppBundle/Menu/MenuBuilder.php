<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 09.04.16
 * Time: 16:07
 */

namespace AppBundle\Menu;

use KnP\Menu\FactoryInterface;

class MenuBuilder
{

    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild("Books");
        $menu->addChild("User");

        $bookmenu = $menu['Books'];
        $bookmenu->addChild('Booklist', array('route' => 'book_list' ));
        $bookmenu->addChild('Create new Book', array ('route' => 'book_new'));

        $usermenu = $menu['User'];
        $usermenu->addChild('list users');
        $usermenu->addChild('create user');

        return $menu;
    }

}
