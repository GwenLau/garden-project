<?php

namespace Controller;


use \W\Controller\Controller;
use Service\ImageManagerService;
use Model\GardensModel;
use Model\PicturesModel;
use Model\PicturesGardensModel;

class GardensController extends Controller
{

	// Détails d'un jardin
	public function details($id)
	{

		$gardensModel = new GardensModel();
		$picturesGardensModel = new PicturesGardensModel();
		$usersModel = new UsersModel();

		$garden = $gardensModel->find(); // Va cibler automatiquement la colonne `id` de la base de données
		$pictures = $picturesGardensModel->findPictures();
		$ownerInfos = $usersModel()->findOwnerInfos();
		$this->show('garden_details', [
			'pictures' => $pictures,
			'garden' => $garden,
			'ownerInfos' => $ownerInfos,]);
	}
}