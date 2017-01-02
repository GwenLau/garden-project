<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;
use Model\RecoverytokensModel;
use Model\GardensModel;
use Twilio\Rest\SplClassLoader;
use Twilio\Rest\Client;




class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$gardensModel = new GardensModel();
		$gardens = $gardensModel->findAll();
		/*$this->redirectToRoute('default_home');*/
		// Idem : 	$this->redirectToRoute('account_all_default');
		$this->show('default/home', ['gardens' => $gardens, 'user' => $this->getUser()]);
	}

	public function login()
	{
		// Si on a essayé de se connecté
		if(isset($_POST['login'])) {

			$authModel = new AuthentificationModel();
			$userModel = new UsersModel();

			// L'id d'un utilisateur
			$userId = $authModel->isValidLoginInfo($_POST['mail'], $_POST['pass']);

		/*	var_dump($userId);
			exit;*/

			if($userId > 0) {
				// Connexion
				$user = $userModel->find($userId);

				// Placer user en session : $_SESSION['user'] = $user
				$authModel->logUserIn($user);
				$this->redirectToRoute('default_home');
			} else {

				// Echec de la connexion
				$this->show('users/login', ['error' => true, 'user' => $this->getUser()]);
			}
		} else {
			$this->show('users/login', ['user' => $this->getUser()]);
		}
	}

	public function logout()
	{
		$authModel = new AuthentificationModel();
		$authModel->logUserOut();
		header('Location: login');
        exit;
	}

	// Affichage du formulaire de demande de nouveau mot de passe
	public function passwordRecovery()
	{
		$tokenModel = new RecoverytokensModel();
		$userModel = new UsersModel();
		if(isset($_POST['send-mail'])) {
			$user = $userModel->getUserByUsernameOrEmail($_POST['email']);
			if(!empty($user)) {
				// Ajouter un token de reset de mot de passe
				$token = \W\Security\StringUtils::randomString(32);
				$tokenModel->insert([
					'id_user' 	=> $user['id'],
					'token' 	=> $token,
				]);

				// Envoyer un mail
				$resetUrl = "http://localhost/" . $this->generateUrl('default_reset_password', ['token' => $token]);

				$messageHtml =<<< EOT
<h1>Réinitialisation de votre mot de passe</h1>
Quelqu'un a demandé la réinitialisation de votre mot de passe.<br>
<a href="$resetUrl">Cliquez ici</a> pour finaliser l'opération<br>
Si vous n'êtes pas à l'origine de ce mail, bla bla bla..
EOT;

				$messagePlain =<<< EOT
Réinitialisation de votre mot de passe
Quelqu'un a demandé la réinitialisation de votre mot de passe.
Accédez à $resetUrl pour finaliser l'opération
Si vous n'êtes pas à l'origine de ce mail, bla bla bla..
EOT;

				$this->sendMail($user['email'], $user['lastname'] . ' ' . $user['firstname'], 'Réinitialisation du mot de passe', $messageHtml, $messagePlain);
			}
		} else {
			$this->show('users/password_recovery', ['user' => $this->getUser()]);
		}
		
	}

	private function sendMail($destAddress, $destName, $subject, $messageHtml, $messagePlain)
	{
		$mail = new \PHPMailer();

		$mail->isSMTP();                                      	// On va se servir de SMTP
		$mail->Host = 'smtp.gmail.com';  						// Serveur SMTP
		$mail->SMTPAuth = true;                               	// Active l'autentification SMTP
		$mail->Username = 'wf3.mailer@gmail.com';             	// SMTP username
		$mail->Password = '$NJ27^^4q7';                   		// SMTP password
		$mail->SMTPSecure = 'tls';                            	// TLS Mode
		$mail->Port = 587;                                    	// Port TCP à utiliser
		$mail->CharSet = 'UTF-8';

		// $mail->SMTPDebug = 2;

		$mail->setFrom('wf3.mail@gmail.com', 'Big Brother Bank Corp. (BBBC)', false);
		$mail->addAddress($destAddress, $destName);     		// Ajouter un destinataire

		$mail->isHTML(true);                                  	 // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $messageHtml;
		$mail->AltBody = $messagePlain;

		$mail->send();
	}

	public function resetPassword($token)
	{
		$tokenModel = new RecoverytokensModel();
		$authModel = new AuthentificationModel();
		$tokens = $tokenModel->search(['token' => $token]);
		if(count($tokens) > 0) {
			$myToken = $tokens[0];
		}
		if(!empty($myToken)) {
			// Le token existe bien en base

			// Si j'ai reçu une soumission
			if(isset($_POST['update-password'])) {
				// Modification du mot de passe, si confirmation exacte
				if($_POST['password'] == $_POST['password-confirm']) {
					$userModel = new UsersModel();
					$userModel->update(['password' => $authModel->hashPassword($_POST['password'])], $myToken['id_user']);

					$tokenModel->delete($myToken['id']);

					$this->redirectToRoute('default_login');
				}
			}

			// Sinon
			$this->show('users/reset_password', ['user' => $this->getUser()]);
		} else {
			$this->redirectToRoute('default_login');
		}
	}

	// Détails du dashboard
	public function dashboard()
	{
		$this->allowTo(['user', 'admin']);
	
		$this->show('users/dashboard', ['user' => $this->getUser()]);

	}
		/*$this->allowTo(['user', 'admin']);
		
		$this->show('users/dashboard', ['user' => $this->getUser()]);
		
	}*/
	

	public function profilDashboard()
		{
			$this->allowTo(['user', 'admin']);

			$this->show('users/profil', ['user' => $this->getUser()]);
		}

	public function messagerie()
		{
			$this->allowTo(['user', 'admin']);
			$error = null;

			if(isset($_POST['envoi_message'])) {		
				if(isset($_POST['destinataire']) && isset($_POST['message'])
						&& !empty($_POST['destinataire']) && !empty($_POST['message'])) {
					$messagesModel = new \Model\MessagesModel();
					$messagesModel->insert([
						'id_send' => $this->getUser()['id'],
						'id_receive' => $_POST['destinataire'],
						'Message' => $_POST['message'],
					]);
				} else {
					$error = "Veuillez compléter tous les champs";
				}
			}

			// $id contient l'ID entré dans l'url 
	/*		$picturesModel = new PicturesModel();
			$picture = $picturesModel->find($id); // Va cibler automatiquement la colonne `id` de la base de données*/
			$usersModel = new \W\Model\UsersModel();
			$users = $usersModel->findAll();
			$messagesModel = new \Model\MessagesModel();
			$messages2 = $messagesModel->findAllMessages2($this->getUser()['id']);
			$this->show('users/messagerie_private', [
				'user' => $this->getUser(),
				'dests' => $users,
				'error' => $error,
				'send'  => $messages2,
			]);
		}


		// Créer et insérer un nouvel utilisateur 
	public function insertUser()
	{
		//$this->allowTo('admin');
		$UsersModel = new UsersModel();
		$authModel = new AuthentificationModel();

		if(isset($_POST['insert-user'])) {
			$errors = [];

			if(empty($_POST['email'])) {
				$errors['email']['empty'] = true;
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
			if(empty($_POST['pseudo'])) {
				$errors['pseudo']['empty'] = true;
			}

			if(empty($_POST['num'])) {
				$errors['num']['empty'] = true;
			}
			
			if(count($errors) === 0) {
				// Ajouter si OK
				$UsersModel->insert([
					'email' 	=> $_POST['email'],
					'password' 	=> $authModel->hashPassword($_POST['pass1']),
					'firstname' => $_POST['firstname'],
					'lastname' 	=> $_POST['lastname'],
					'pseudo' 	=> $_POST['pseudo'],
					'nb_tries' 	=> 0,
					'role'		=> user,

				]);
				
				// redirection vers connexion
			}
			else {
				$this->show('users/add', ['errors' => $errors, 'user' => $this->getUser()]);
			}
				
		}
			$this->show('users/add', ['user' => $this->getUser()]);
	}

//david function contact proprio jardin
	public function contact($idGarden)
		{
			$this->allowTo(['user', 'admin']);
			$error = null;

			if(isset($_POST['contact'])) {		
				if(isset($_POST['destinataire']) && isset($_POST['message'])
						&& !empty($_POST['destinataire']) && !empty($_POST['message'])) {
					$messagesModel = new \Model\MessagesModel();
					$messagesModel->insert([
						'id_send' => $this->getUser()['id'],
						'id_receive' => $_POST['destinataire'],
						'id_garden' => $idGarden,
						'Message' => $_POST['message'],
					]);
				} else {
					$error = "Veuillez compléter tous les champs";
				}
			}

			$gardenModel = new GardensModel();
			$garden = $gardenModel->find($idGarden);
			$ownerId = $garden['id_user'];

			

			/*$sid = "ACf25767309ce67abfed16cbacaab0a4f3"; // Your Account SID from www.twilio.com/console
			$token = "73c2331465d98fb87b03c4aea6afb761"; // Your Auth Token from www.twilio.com/console

			$client = new Client($sid, $token);
			$message = $client->messages->create(
			  '+33677062090', // Text this number
			  array(
			    'from' => '+33644641630', // From a valid Twilio number
			    'body' => 'Bonjour vous avez une demande de jardin YoupiGarden!'
			  )
			);
*/

 $this->show('users/contact_private', [
				'user' => $this->getUser(),
				'error' => $error,
				'destinataire' => $ownerId,
			]);


					}

	public function received()
		{
			$this->allowTo(['user', 'admin']);

			$messagesModel = new \Model\MessagesModel();
			$messages = $messagesModel->findAllMessages($this->getUser()['id']);
			$sid = "ACf25767309ce67abfed16cbacaab0a4f3"; // Your Account SID from www.twilio.com/console
			$token = "73c2331465d98fb87b03c4aea6afb761"; // Your Auth Token from www.twilio.com/console

			$client = new Client($sid, $token);
			$message = $client->messages->create(
			  '+33677062090', // Text this number
			  array(
			    'from' => '+33644641630', // From a valid Twilio number
			    'body' => 'Bonjour vous avez une demande de jardin YoupiGarden!'
			  )
			);
			$this->show('users/messagerie_received', [
				'user' => $this->getUser(),
				'received' => $messages,
			]);
		}

	public function dashDisplayAll()
	{
	
		$gardensModel = new GardensModel();

		if(isset($_GET['s'])) {
			$gardens = $gardensModel->searchAllAndChilds([
				'City' 			=> $_GET['s'],
				'Description' 	=> $_GET['s'],
				'Streetname'	=> $_GET['s'],
				'Name'			=> $_GET['s'],
			]);
		} else {
			$gardens = $gardensModel->findAllAndChilds();
		}

		//$role = $this->getUser()['role'];

		$this->show('users/search', ['allGardens' => $gardens, 'user' => $this->getUser()]);
	}

}