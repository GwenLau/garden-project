<?php

namespace Controller;


use \W\Controller\Controller;
use Service\ImageManagerService;
use Model\GardensModel;

class PicturesController extends Controller
{

	// Détails d'une image
	public function details($id)
	{
		$this->allowTo(['user', 'admin']);
		// $id contient l'ID entré dans l'url 
		$gardensModel = new GardensModel();
		
		$garden = $gardensModel->find($id); // Va cibler automatiquement la colonne `id` de la base de données
		$this->show('picture_details', ['picture' => $picture]);
	}
}