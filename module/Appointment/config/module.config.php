<?php
return array(
     'controllers' => array(
         'invokables' => array(
             //list of all the controllers provided by the module Appointment
             'Appointment\Controller\Appointment' => 'Appointment\Controller\AppointmentController',
             
         ),
     ),
    'router' => array(
         'routes' => array(
             'appointment' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/appointment[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Appointment\Controller\Appointment',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'appointment' => __DIR__ . '/../view',
         ),
     ),
 );