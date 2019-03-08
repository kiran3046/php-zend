<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'AppointmentRest\Controller\AppointmentRest' => 'AppointmentRest\Controller\AppointmentRestController',
        ),
    ),
// REST rounting to call the RestOCntroller
    'router' => array(
        'routes' => array(
            'appointment-rest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/appointment-rest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AppointmentRest\Controller\AppointmentRest',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);