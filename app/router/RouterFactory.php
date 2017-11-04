<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
        $router = new RouteList();
        $router[] = $adminRouter = new RouteList('Admin');
        $adminRouter[] = new Route('admin/<presenter>/<action>/<id>',array(
            'presenter' => 'Homepage',
            'action' => 'default',
            'id' => null
        ));
        
        $router[] = $frontRouter = new RouteList('Front');
        $frontRouter[] = new Route('registrace','Sign:register');
        $frontRouter[] = new Route('<presenter>/<action>[/<id>]', array(
            'presenter' => 'Homepage',
            'action' => 'default',
            'id' => null
		));
		
		return $router;
	}
}
