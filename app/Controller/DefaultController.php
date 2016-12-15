<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home');
	}

		// Créer et insérer un nouvel utilisateur 
	public function insertUser()
	{
		//$this->allowTo('admin');
		$UsersModel = new UsersModel();
		$authModel = new AuthentificationModel();

		if(isset($_POST['insert-user'])) {
			$errors = [];

			if(empty($_POST['mail'])) {
				$errors['mail']['empty'] = true;
			}
			if(empty($_POST['pass1'])) {
				$errors['pass1']['empty'] = true;
			}	
			if(empty($_POST['firstname'])) {
				$errors['firstname']['empty'] = true;
			}
			if(empty($_POST['lastname'])) {
				$errors['lastname']['empty'] = true;
			}
			
			if(count($errors) === 0) {
				// Ajouter si OK
				$UsersModel->insert([
					'mail' 		=> $_POST['mail'],
					'password' 	=> $authModel->hashPassword($_POST['pass1']),
					'firstname' => $_POST['firstname'],
					'lastname' 	=> $_POST['lastname'],
					'nb_tries' 	=> 0,

				]);
				
				// redirection vers connexion
			}
			else {
				$this->show('users/add', ['errors' => $errors]);
			}

				
		}
			$this->show('users/add');
	}

}