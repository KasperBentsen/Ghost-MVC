<?php

	$routes = array (
		'controller' => 'news',
		'pattern' => array (
			'/news/{$title}/' => 'show',
			'/news/{$title}/{delete}/woot/woot/' => 'delete'
		)
	);