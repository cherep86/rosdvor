<?php


namespace Point;


use Point\Model\Point;
use Point\Model\PointTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceManager;

class Module {

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'Point\Model\PointTable' =>  function(ServiceManager $sm) {
					$tableGateway = $sm->get('PointTableGateway');
					$table = new PointTable($tableGateway);
					return $table;
				},
				'PointTableGateway' => function (ServiceManager $sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Point());
					return new TableGateway('point', $dbAdapter, null, $resultSetPrototype);
				},
			),
		);
	}

} 
