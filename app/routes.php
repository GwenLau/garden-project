<?php

	$w_routes = array(
		['GET', 		'/', 										'Default#home', 				'default_home'],
		['GET|POST',	'/login',									'Default#login',				'users_login'],
		['GET',			'/logout',									'Default#logout',				'default_logout'],
		['GET|POST',	'/users/password-recovery',					'Default#passwordRecovery',		'default_password_recovery'],
		['GET|POST',	'/users/reset-password/[:token]',			'Default#resetPassword',		'default_reset_password'],
		['GET', 		'/gardens/list', 							'Gardens#displayAll', 			'garden_all'],
		['GET|POST', 	'/users/dashboard', 						'Default#dashboard', 			'default_dashboard'],
		['GET|POST',	'/users/add',								'Default#insertUser',			'default_add'],
		['GET|POST',	'/users/profil',							'Default#manageProfile',		'default_profil'],
		['GET|POST',	'/users/messagerie',						'Default#messagerie',			'default_messagerie'],
		['GET|POST',	'/users/garden/[i:id]',						'Default#contact',				'default_contact'],
		['GET|POST',	'/users/received',							'Default#received',				'default_received'],
		['GET|POST', 	'/users/search', 							'Default#dashDisplayAll', 		'default_search'],
		['GET', 		'/gardens/list', 							'Gardens#displayAll', 			'gardens_all'],
		['GET|POST', 	'/add_picture', 							'Picture#addPicture', 			'picture/add_picture'],
		['GET',			'/gardens/details/[i:id]',					'Gardens#details',				'garden_details'],
		['GET|POST',	'/dashboard/gardens',						'Gardens#addGarden',			'users/dashboard_mesjardins'],
		['GET|POST',	'/dashboard/gardens-manager',				'Gardens#displayListOfGardens',	'users/dashboard_mesjardins_manager'],
		['GET|POST',	'/dashboard/gardens-actions',				'Gardens#actions',				'users/gardens_actions'],
	);