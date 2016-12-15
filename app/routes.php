<?php
	
	$w_routes = array(
		['GET', 		'/', 										'Default#home', 			'default_home'],
		['GET|POST',	'/login',									'Default#login',			'default_login'],
		['GET',			'/logout',									'Default#logout',			'default_logout'],
		['GET|POST',	'/users/password-recovery',					'Default#passwordRecovery',	'default_password_recovery'],
		['GET|POST',	'/users/reset-password/[:token]',			'Default#resetPassword',	'default_reset_password'],
		['GET|POST',	'/users/add',								'Default#insertUser',		'default_add'],

	);