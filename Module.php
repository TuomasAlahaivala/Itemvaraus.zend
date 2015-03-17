<?php
namespace Vihko;

use Vihko\Model\Vihko;
use Vihko\Model\VihkoTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;

class Module{
	
        public function getAutoloaderConfig()
        {
            return array(
                'Zend\Loader\ClassMapAutoloader' => array(
                    __DIR__ . '/autoload_classmap.php',
                ),
                'Zend\Loader\StandardAutoloader' => array(
                    'namespaces' => array(
                        __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    ),
                ),
            );
        }
	
	public function getConfig(){
		
		return include __DIR__ . '/config/module.config.php';
	}
	
	public function getServiceConfig(){
		
		return array(
			'factories' => array(
				'Vihko\Model\LaitteetTable' => function($sm){
					$tableGateway = $sm->get('VihkoTableGateway');
					$table = new VihkoTable($tableGateway);
					return $table;
				},
				'VihkoTableGateway' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Vihko());
					return new TableGateway('vih_items', $dbAdapter, null, $resultSetPrototype);
				},
			),
		);
	}
	public function initSession($config){
    
		$sessionConfig = new SessionConfig();
		$sessionConfig->setOptions($config);
		$sessionManager = new SessionManager($sessionConfig);
		$sessionManager->start();
		Container::setDefaultManager($sessionManager);
	}
}
?>