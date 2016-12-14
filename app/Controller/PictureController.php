<?php

namespace Controller;

use Model\PicturesModel;
use \W\Controller\Controller;
//http://localhost/revisions/demousers/public/login#

class PictureController extends Controller
{
	// Affichage de la liste des comptes
	public function displayAll($mode = 'name')
	{
		$this->allowTo(['user', 'admin']);
		// $mode : soit sort-name, soit sort-balance

		// Récupère les comptes
		// Il nous faut le modèle pour cela :
		$picturesModel = new PicturesModel();

		if($mode == 'name') {
			$pictures = $picturesModel->findAll('owner');
		} else {
			$pictures = $picturesModel->findAll('balance');
		}

		$role = $this->getUser()['role'];

		$this->show('picture/all', ['allPictures' => $pictures, 'role' => $role]);
	}

	// Détails d'un compte
	public function details($id)
	{
		$this->allowTo(['user', 'admin']);
		// $id contient l'ID entré dans l'url (ex: /accounts/details/35)
		$picturesModel = new PicturesModel();
		$picture = $picturesModel->find($id); // Va cibler automatiquement la colonne `id` de la base de données
		$this->show('picture/details', ['picture' => $picture]);
	}

	// Créditer ou débiter le compte
	/*
	 * Fait 2 choses :
	 * - Affiche le formulaire de modification
	 * - Prend en compte les modifications quand on a cliqué sur `submit`
	 */
/*	public function change($id)
	{
		$this->allowTo('admin');
		$picturesModel = new PicturesModel();

		// Si on a reçu la soumission du formulaire
		if(isset($_POST['send'])) {
			// Modifier le solde en fonction du type d'opération
			$account = $accountsModel->find($id);
			$newBalance = 0;
			if($_POST['operation'] == 'credit') {
				$newBalance = $account['balance'] + $_POST['amount'];
			} elseif($_POST['operation'] == 'debit') {
				$newBalance = $account['balance'] - $_POST['amount'];
			}

			$accountsModel->update(['balance' => $newBalance], $id);
			// Rediriger vers la liste
			$this->redirectToRoute('account_all_default');
		}
		// Sinon, on affiche le formulaire
		else {
			// $id contient l'ID entré dans l'url (ex: /accounts/details/35)
			$account = $accountsModel->find($id);
			$this->show('account/change', ['account' => $account]);
		}
	}

	public function add()
	{
		$this->allowTo('admin');
		$accountsModel = new AccountsModel();

		if(isset($_POST['add-user'])) {
			$errors = [];

			if(empty($_POST['owner'])) {
				$errors['owner']['empty'] = true;
			}
			if(empty($_POST['balance'])) {
				$errors['balance']['empty'] = true;
			}
			if(empty($_POST['currency'])) {
				$errors['currency']['empty'] = true;
			}

			if(count($errors) === 0) {
				// Ajouter si OK
				$accountsModel->insert([
					'owner' 	=> $_POST['owner'],
					'balance' 	=> $_POST['balance'],
					'currency' 	=> $_POST['currency'],
				]);
				$this->redirectToRoute('account_all_default');
			} else {
				$this->show('account/add', ['errors' => $errors]);
			}
		}

		else {
			// Sinon, afficher le formulaire
			$this->show('account/add');
		}
	}

	// Suppression d'un compte
	public function delete($id)
	{
		$this->allowTo('admin');

		$accountsModel = new AccountsModel();
		$accountsModel->delete($id);
		$this->redirectToRoute('account_all_default');
	}

	// Modification du solde en AJAX
	public function ajaxOperation()
	{
		$this->allowTo('admin');

		$accountsModel = new AccountsModel();
		if(isset($_POST['accountId']) && ctype_digit($_POST['accountId'])) {
			$accountId = $_POST['accountId'];
			if(!empty($_POST['amount']) && filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT)) {
				$amount = $_POST['amount'];
			} else {
				$this->showJson(['errorAmount' => true]);
			}

			// Modifier le solde en fonction du type d'opération
			$account = $accountsModel->find($accountId);
			$newBalance = 0;
			if($_POST['operation'] == 'credit') {
				$newBalance = $account['balance'] + $amount;
			} elseif($_POST['operation'] == 'debit') {
				$newBalance = $account['balance'] - $amount;
			}

			$accountsModel->update(['balance' => $newBalance], $accountId);
			$this->showJson(['success' => true, 'newBalance' => $newBalance]);
		}
	}*/
}