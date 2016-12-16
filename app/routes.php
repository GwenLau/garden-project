<?php
	
	$w_routes = array(
		['GET', 		'/', 										'Default#home', 			'default_home'],
		['GET|POST',	'/login',									'Default#login',			'users_login'],
		['GET',			'/logout',									'Default#logout',			'default_logout'],
<<<<<<< HEAD
		['GET|POST',	'/users/password-recovery',					'Default#passwordRecovery',	'default_password_recovery'],
		['GET|POST',	'/users/reset-password/[:token]',			'Default#resetPassword',	'default_reset_password'],
		['GET', 		'/pictures/list', 							'Picture#displayAll', 			'picture_all'],
		['GET|POST', 		'/users/dashboard', 							'Default#dashboard', 			'default_dashboard']
=======
		['GET|POST',	'/user/password-recovery',					'Default#passwordRecovery',	'default_password_recovery'],
		['GET|POST',	'/user/reset-password/[:token]',			'Default#resetPassword',	'default_reset_password'],
		['GET|POST', 	'/add-picture', 							'Picture#addPicture', 		'pictures/add-picture'],
>>>>>>> gwendo
	);