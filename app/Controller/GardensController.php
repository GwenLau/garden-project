<?php

namespace Controller;


use \W\Controller\Controller;
use Service\ImageManagerService;
use Model\GardensModel;

//fonction david recherche
class GardensController extends Controller
{
	// Affichage de la liste des images
	public function displayAll()
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

		$this->show('garden/all', ['allGardens' => $gardens, 'user' => $this->getUser()]);
	}

//fonction david recherche

}