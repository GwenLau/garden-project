<?php

namespace Controller;

use \W\Controller\Controller;
use Service\ImageManagerService;
use Model\GardensModel;
use Model\PicturesModel;
use Model\PicturesGardensModel;
use Model\UsersModel;

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

//fonction Christine >> affichage du détail d'un jardin :
//
// AFFICHAGE DES 3 PHOTOS DU JARDIN : 
// Afficher les 3 images d'un jardin avec :
// 1) 1 image pleine page = image principale positionnée 1 en BDD 
// 2) affichage de 2 images plus petites du jardin = images positionnées 2 et 3 en BDD
// 
// AFFICHAGE DE 4 CHAMPS DE TEXTE :
// 1) le pseudo du propriétaire du jardin (table "users", champs "pseudo")
// 2) le nom, la ville et la description du jardin (table "gardens", champs "name", "city" et "description")
// 
// PROBLEME : impossible de faire remonter les infos de Users Model > d'où création d'un autre modèle = OwnerModel + public function findOwner() >> Mais ça ne fonctionne toujours pas
// Les seuls champs qui s'affichent sont ceux appelés par la fonction findGarden dans GardensModel
// Ni les images, ni les infos users (pseudo et avatar) ne s'affichent.
// 
// Nous sommes bloqués depuis 2 jours. Jérôme (front end) n'a pas pu m'aider hier.
// Je ne peux demander d'aide aux autres élèves qui sont occupés jusque vendredi.
// Et nous sommes seuls jusque jeudi, la soutenance étant vendredi.
// Si mon problème n'est pas résolu, je n'aurai pas grand chose à montrer.
// Pourrais-tu stp aider, en regardant les documents envoyés ?
// Possible de se faire un tchat ou call aussi pour débugger stp.
// 
// Par avance un grand merci pour ton aide.

	// Détails d'un jardin
	public function details($id)
	{
		$gardensModel = new GardensModel();
		// $ownerModel = new OwnerModel();

		$garden = $gardensModel->findGarden($id);
		// $owner = $ownerModel->findOwner($id);
		
		//$user = Array(
			//////'avatar'=>'test',
			////'pseudo'=> 'tata'
		//);
		$this->show('garden/details', ['garden' => $garden, 'owner' => $owner, 'user' => $this->getUser()]);
	}

	public function displayAllInMap()
	{
		$gardensModel = new GardensModel();

		$gardens = $gardensModel->findAll();

		echo json_encode($gardens);
	}

	public function addGarden()
	{
		/*print_r($_FILES);*/
		// $this->allowTo('admin');
		$gardensModel = new GardensModel();
		$picturesModel = new PicturesModel();
		$picturesGardensModel = new PicturesGardensModel();
		$imageManagerService = new ImageManagerService();

		if(isset($_POST['add-garden'])) {
			$errors = [];
			$fileNames = [];

			if(empty($_POST['name']) || strlen($_POST['name']) < 5) {
				$errors['name']['emptyorshort'] = true;
			}
			if(empty($_POST['description']) || strlen($_POST['description']) < 10) {
				$errors['description']['emptyorshort'] = true;
			}
			if(empty($_POST['streetname'])) {
				$errors['streetname']['empty'] = true;
			}
			if(empty($_POST['citycode']) || preg_match("/[0-9]{5}/", $_POST['citycode']) == false) {
				$errors['citycode']['emptyorfalse'] = true;
			}
			if(empty($_POST['city']) || strlen($_POST['city']) < 3) {
				$errors['city']['emptyorshort'] = true;
			}

			if(empty($errors)) {

				// begin loop
				for($i = 0; $i < count($_FILES['my-file']['name']) ; $i++) {

					// Vérification du fichier uploadé
					if ($_FILES['my-file']['error'][$i] != UPLOAD_ERR_OK) {
		        
		        		$errors['my-file'][$i] = 'Merci de choisir un fichier';
		    		} else {
			        	$finfo = new \finfo(FILEINFO_MIME_TYPE);
			        	// Récupération du Mime
			        	$mimeType = $finfo->file($_FILES['my-file']['tmp_name'][$i]);
			        	$extFoundInArray = array_search(
			            	$mimeType, array(
				                'jpg' => 'image/jpeg',
				                'png' => 'image/png',
				                'gif' => 'image/gif',
			            	)
			        	);
			        	if ($extFoundInArray === false) {
			            	$errors['my-file'][$i] =  'Le fichier n\'est pas une image';
			        	} else {
			            // Renommer nom du fichier
				            $shaFile = sha1_file($_FILES['my-file']['tmp_name'][$i]);
				            $nbFiles = 0;
				            $path = './assets/uploads/';
				            // $fileNames = '';
				            // boucle pour récupérer chaque image téléchargée
				            do {
				                $fileNames [$i]= $shaFile . $nbFiles . '.' . $extFoundInArray;
				                $fullPath = $path . $fileNames[$i];
				                $nbFiles++;
			            	} while(file_exists($fullPath));

				            if(count($errors) === 0) {
				            
				                $moved = move_uploaded_file($_FILES['my-file']['tmp_name'][$i], $fullPath);
				                if (!$moved) {
				                    $errors['my-file'][$i] = 'Erreur lors de l\'enregistrement';
				                } else {			

					                $imageManagerService->resize($fullPath, null, 200, 200, true, $path . 'min/' . $fileNames[$i], false);	
				            	}
				            }
		        		}
		    		} // fin si fichier present
	    		}
	    		// end loop
	    	}

	    	// Si une erreur sur un des fichiers
	    	if(!empty($errors['my-file'])) {
	    		// Supprimer les images qui viennent d'etre uploadees
	    		foreach($fileNames as $fileName) {
	    			$path = './assets/uploads/';
	    			unlink($path . $fileName);
	    		}
	    	}

	    	print_r($errors);
			
			if(count($errors) === 0) {
				$url = 'https://maps.googleapis.com/maps/api/geocode/json?';

				$urlParams = http_build_query([
				    'address' => $_POST['streetnumber'] . ' ' . $_POST['streetname'] . ' ' . $_POST['citycode'] . ' ' . $_POST['city'],
				    'key' => 'AIzaSyB7NXsssmw5516Js0-eL_oznUQZA3CEU-U',
				]);

				$responseJSON = file_get_contents($url . $urlParams);
				$response = json_decode($responseJSON);

				$lat = $response->results[0]->geometry->location->lat;
				$lng = $response->results[0]->geometry->location->lng;

				$gardensModel->insert([
					'id_user'		=> 1, //$_SESSION['user']['id'],
					'Name'	 		=> $_POST['name'],
					'Description' 	=> $_POST['description'],
					'Streetnumber'	=> $_POST['streetnumber'],
					'Streetname'	=> $_POST['streetname'],
					'CityCode'		=> $_POST['citycode'],
					'City'			=> $_POST['city'],					
					'Name'	 		=> $_POST['name'],
					'lat'			=> $lat,
					'lng'			=> $lng,
				]);
				$gardenId = $gardensModel->lastInsertId();

				foreach($fileNames as $fileName) {


					$picturesModel->insert([
						'id_user'		=> 1,
						'URL'			=> $fileName,	
					]);
					$pictureId = $picturesModel->lastInsertId();

					$picturesGardensModel->insert([
						'id_picture'	=> $pictureId,
						'id_garden'		=> $gardenId,
					]);
				}
			}
		}
		$this->show('users/dashboard_mesjardins', ['errors' => $errors]);
	}
}
	

	

