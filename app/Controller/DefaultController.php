<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Model\UsersModel;
use Model\RecoverytokensModel;
use Model\GardensModel;
use Service\ImageManagerService;
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
		$mail->Username = 'youpigarden@gmail.com';/*wf3.mailer@gmail.com             	*/// SMTP username
		$mail->Password = 'YoupiGarden0703';/*'$NJ27^^4q7';                 */  		// SMTP password
		$mail->SMTPSecure = 'tls';                            	// TLS Mode
		$mail->Port = 587;                                    	// Port TCP à utiliser
		$mail->CharSet = 'UTF-8';

		// $mail->SMTPDebug = 2;
		$mail->setFrom('youpigarden@gmail.com', 'Youpi Garden', false);
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

					$this->redirectToRoute('users_login');
				}
			}

			// Sinon
			$this->show('users/reset_password', ['user' => $this->getUser()]);
		} else {
			$this->redirectToRoute('users_login');
		}
	}

	// Détails du dashboard : affichage des informations générales de l'utilisateurs
	public function dashboard()
	{
		$this->allowTo(['user', 'admin']);
	
		$this->show('users/dashboard', ['user' => $this->getUser()]);

	}
	
	// Affichage des détails dans la sidebar
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
					$userModel = new UsersModel();
					$userInfos = $userModel->find($_POST['destinataire']);
					$num = $userInfos['num'];

					 $sid = "ACf25767309ce67abfed16cbacaab0a4f3"; // Your Account SID from www.twilio.com/console
					 $token = "73c2331465d98fb87b03c4aea6afb761"; // Your Auth Token from www.twilio.com/console

					 $client = new Client($sid, $token);
					 $message = $client->messages->create(
					   $num, // Text this number
					   array(
					 	'from' => '+33644641630', // From a valid Twilio number
					 	'body' => 'Bonjour vous avez une demande de jardin YoupiGarden!'
					   )
					 );
					 $this->redirectToRoute('default_home');
				} else {
					$error = "Veuillez compléter tous les champs";
				}
			}

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
					$userModel = new UsersModel();
					$userInfos = $userModel->find($_POST['destinataire']);
					$num = $userInfos['num'];

					 $sid = "ACf25767309ce67abfed16cbacaab0a4f3"; // Your Account SID from www.twilio.com/console
					 $token = "73c2331465d98fb87b03c4aea6afb761"; // Your Auth Token from www.twilio.com/console

					 $client = new Client($sid, $token);
					 $message = $client->messages->create(
					   $num, // Text this number
					   array(
					 	'from' => '+33644641630', // From a valid Twilio number
					 	'body' => 'Bonjour vous avez une demande de jardin YoupiGarden!'
					   )
					 );
					 $this->redirectToRoute('default_home');
				} else {
					$error = "Veuillez compléter tous les champs";
				}
			}

			$gardenModel = new GardensModel();
			$garden = $gardenModel->find($idGarden);
			$ownerId = $garden['id_user'];

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

			/*$client = new Client($sid, $token);
			$message = $client->messages->create(
			  '+33677062090', // Text this number
			  array(
				'from' => '+33644641630', // From a valid Twilio number
				'body' => 'Bonjour vous avez une demande de jardin YoupiGarden!'
			  )
			);*/
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

	// Fonction de gestion du profil de l'utilisateur
	public function manageProfile()
		{
			$id = $_SESSION['id'];
			
			$this->allowTo(['user', 'admin']);
			
			
			if(isset($_POST['save-new-avatar'])){
				$this->addAvatar($id);
			} else if(isset($_POST['save-new-email'])) {
				$this->newEmail($id);
			} else if(isset($_POST['save-new-password'])) {
				$this->newPwd($id);
			}

			$this->show('users/profil', ['user' => $this->getUser()]);
		}

	// Fonction pour ajouter un avatar (Dashboard > Mon compte)
	private function addAvatar()
	{
		
		$UsersModel = new UsersModel();
		$ImageManagerService = new ImageManagerService();
		$fileName = '';
		$errors = '';

		$this->allowTo(['user', 'admin']);

		// Insertion d'un avatar
		if(isset($_POST['save-new-avatar'])){
			// Vérifier si le téléchargement du fichier n'a pas été interrompu
			if ($_FILES['my-avatar']['error'] != UPLOAD_ERR_OK) {
				$errors['my-avatar'] = 'Merci de choisir un fichier';
			} else {
				// Objet FileInfo
				$finfo = new \finfo(FILEINFO_MIME_TYPE);

				// Récupération du Mime
				$mimeType = $finfo->file($_FILES['my-avatar']['tmp_name']);

				$extFoundInArray = array_search(
					$mimeType, array(
						'jpg' => 'image/jpeg',
						'png' => 'image/png',
						'gif' => 'image/gif',
					)
				);
				
				if ($extFoundInArray === false) {
					$errors['my-avatar'] =  'Le fichier n\'est pas une image';
				} else {
					// Renommer nom du fichier
					$shaFile = sha1_file($_FILES['my-avatar']['tmp_name']);
					$nbFiles = 0;
				
					do {
						$fileName = $shaFile . $nbFiles . '.' . $extFoundInArray;
						$path = './assets/uploads/users/' . $fileName;
						$nbFiles++;
					} while(file_exists($path));

					if(count($errors) === 0) {

					$moved = move_uploaded_file($_FILES['my-avatar']['tmp_name'], $path);
						if (!$moved) {
							echo 'Erreur lors de l\'enregistrement';
						} 
					}
				}    		
			}

			if(count($errors) === 0) {
			$usersModel->insert([
					'avatar'		=> $fileName,		
				]);
			}
		}
		$this->show('users/profil', ['errors' => $errors]);

	} // Fin de la fonction addAvatar

	private function newEmail()
	{
		$this->allowTo(['user', 'admin']);
		$error = null;
		$newEmail = $_POST['new-email'];
		

		// Enregistrement d'un nouvel e-mail
		if(isset($_POST['save-new-email'])){
			// Vérifications du nouvel e-mail saisi
			if(isset($_POST['new-email']) && !empty($_POST['new-email']) && filter_var($newEmail, FILTER_VALIDATE_EMAIL)){
				$usersModel = new UsersModel();
				$id = $_SESSION['id'];
				$usersModel->update(['email' => $newEmail], $id);

			} else {
				$error = 'L\'e-mail saisi n\'est pas valide';
			};
			$this->show('users/profil', [
				'user' => $this->getUser(),
				'error' => $error,
			]);
		}
	}

	private function newPwd()
	{
		$this->allowTo(['user', 'admin']);
		$error = null;
		$newPassword = $_POST['new-password'];

		// Enregistrement d'un nouveau mot-de-passe	
		if(isset($_POST['save-new-password'])){
			// Vérifications du mot-de-passe saisi
			if(isset($_POST['new-password']) && !empty($_POST['new-password']) && strlen($_POST['new-password'] >= 3) && $_POST['new-password'] === $_POST['confirm-new-password']) {
				$newPassword = hashPassword($_POST['new-password']);
				$usersModel = new UsersModel();
				$usersModel->update([
					'password' => $newPassword,
					'id' => $_SESSION['user_id'],
					]);
			} else {
				$error = 'Le mot-de-passe saisi n\'est pas valide';
			}
			$this->show('users/profil', [
				'user' => $this->getUser(),
				'error' => $error,
			]);
		}	
	}

}