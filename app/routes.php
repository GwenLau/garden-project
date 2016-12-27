<?php

	$w_routes = array(
		['GET', 		'/', 										'Default#home', 			'default_home'],
		['GET|POST',	'/login',									'Default#login',			'users_login'],
		['GET',			'/logout',									'Default#logout',			'default_logout'],
		['GET|POST',	'/users/password-recovery',					'Default#passwordRecovery',	'default_password_recovery'],
		['GET|POST',	'/users/reset-password/[:token]',			'Default#resetPassword',	'default_reset_password'],
		['GET', 		'/gardens/list', 							'Gardens#displayAll', 		'gardens_all'],
		['GET|POST', 	'/users/dashboard', 						'Default#dashboard', 		'default_dashboard'],
		['GET|POST', 	'/add_picture', 							'Picture#addPicture', 		'picture/add_picture'],
		['GET|POST',	'/users/add',								'Default#insertUser',		'default_add'],
		['GET',			'/gardens/details/[i:id]',					'Gardens#details',			'garden_details'],
		['GET|POST',	'/users/profil',							'Default#profilDashboard',	'default_profil'],
		['GET|POST',	'/users/messagerie',						'Default#messagerie',	'default_messagerie'],
		['GET|POST',	'/dashboard/gardens',						'Gardens#addGarden',	'users/dashboard_mesjardins'],

		
	);