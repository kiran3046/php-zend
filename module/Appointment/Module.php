<?php
namespace Appointment;

use Appointment\Model\Appointment;
 use Appointment\Model\AppointmentTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;


 class Module implements AutoloaderProviderInterface, ConfigProviderInterface,ServiceProviderInterface
 {
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

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     
      public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Appointment\Model\AppointmentTable' =>  function($sm) {
                     $tableGateway = $sm->get('AppointmentTableGateway');
                     $table = new Model\AppointmentTable($tableGateway);
                     return $table;
                 },
                 'AppointmentTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Appointment());
                     return new TableGateway('appointment', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }