<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Vihko\Controller\Vihko' => 'Vihko\Controller\VihkoController',
		),
	),
	'router' => array(
		'routes' => array(
			'vihko' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/vihko[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Vihko\Controller\Vihko',
						'action' => 'index',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'vihko' => __DIR__ . '/../view',
		),
	),
);
?>