<?php 

namespace W\Security;

use 

class AuthentificationModel
{

//Vérifie qu'une combinaison d'email/usermail et mot de passe (en clair) sont présents en bdd et valides
///@param string $usernameOrEmail Le pseudo ou l'email à tets
///@param string $plainPassword Le mot de passe en clair à tester
//àreturn int 0 si invalide, l'identifiant de l'utilisateur si valide
//
//
public function isValidLoginInfo($usernameOrEmail, $plainPassword)
{
	$app = getApp();

	$usersModel = new UsersModel();
	$usernameOrEmail = strip_tags(trim($usernameOrEmail);
		if(!$foundUser){
			return 0;
		}

	if(password_verify($plainPassword, $foudUser[$app->getConfig('security_password_property')])){
		return (int) $founfUser[$app->getConfig('security_id_property')];
	}

	return 0;
}

//Connecte une utilisateur
//@param arry $user Le tableau contenant les données utilisateurs

public function logUserIn($user)
{
	$app = getApp();
	//retire le mot de passe de la session
	unset($user[$app->getConfig('security_password_property')]);
	$_SEESION['user'] = $user;
}

}





 