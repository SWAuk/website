<?php

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use SwaUK\Component\Swa\Administrator\Extension\SwaComponent;

return new class implements ServiceProviderInterface {
	public function register( Container $container ) {
		Log::addLogger(array(
			// Sets file name
			'text_file' => "com_swa.log.all"
		));
		$namespace = '\\SwaUK\\Component\\Swa';
		$container->registerServiceProvider(new CategoryFactory($namespace));
		$container->registerServiceProvider( new MVCFactory( $namespace ) );
//		$container->registerServiceProvider( new RouterFactory($namespace));
		$container->registerServiceProvider( new ComponentDispatcherFactory($namespace));

		$container->set(
			ComponentInterface::class,
			function ( Container $container ) {
				$component = new SwaComponent( $container->get( ComponentDispatcherFactoryInterface::class ) );
				$component->setMVCFactory( $container->get( MVCFactoryInterface::class ) );
//				$component->setRouterFactory($container->get(RouterFactory::class));
				$component->setRegistry($container->get(Registry::class));
				return $component;
			}
		);
	}
};
