<?php

namespace Controller;



use \W\Controller\Controller;
use Service\ImageManagerService;
use Model\GardensModel;
use Model\PicturesModel;
use Model\PicturesGardensModel;




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



	// Détails d'une image
	public function details($id)
	{
		$this->allowTo(['user', 'admin']);
		// $id contient l'ID entré dans l'url 
		$gardensModel = new GardensModel();
		$garden = $gardensModel->find($id); // Va cibler automatiquement la colonne `id` de la base de données
		$this->show('garden_details', ['garden' => $garden]);
	}

	// Fonction de récupération de tous les jardins enregistrées pour le projet (utilisation dans la Google Maps)
	public function displayAllInMap()
	{
		$gardensModel = new GardensModel();

		$gardens = $gardensModel->findAll();

	}

	// Fonction d'ajout d'un jardin
	public function addGarden()
	{

		$this->allowTo(['user', 'admin']);
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

				$newGarden = $gardensModel->insert([
					'id_user'		=> $_SESSION['user']['id'],
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
				$gardenId = $newGarden['id'];

				$i = 1;
				foreach($fileNames as $fileName) {


					$newPicture = $picturesModel->insert([
						'id_user'		=> $_SESSION['user']['id'],
						'URL'			=> $fileName,	
					]);

					$pictureId = $newPicture['id'];

					$picturesGardensModel->insert([
						'id_picture'	=> $pictureId,
						'id_garden'		=> $gardenId,
						'position'		=> $i,
					]);

					$i++;
				}
			}
		}
		$this->show('users/dashboard_mesjardins', ['errors' => $errors]);
	}

	// Fonction pour l'affichage des jardins / utilisateur (pour la gestion de ses jardins)
	public function displayListOfGardens()
	{
		$this->allowTo(['user', 'admin']);

		$gardensModel = new GardensModel();
		$gardens = $gardensModel->listOfGardens($id);

		$this->show('users/dashboard_mesjardins_manager', ['gardens' => $gardens, 'user' => $this->getUser()]);
	}

	// Pour la suppression du jardin avec AJAX
	public function actions()
	{
		$this->allowTo(['user', 'admin']);
		$_POST['id'] = 43;

		$gardensModel = new GardensModel();
		if(!$_POST['id'] && !ctype_digit($_POST['id'])){
			$response = FALSE;
		} else {
			$gardens = $gardensModel->deleteGarden($_POST['id']); 
			$response = TRUE;
		}

		$this->show('users/gardens_actions', ['response' => $response]);
	}

	// Fonction de suppression d'un jardin en BDD
	public function deleteGarden($id)
	{
		$this->allowTo(['user', 'admin']);

		$gardensModel = new GardensModel();
		$picturesModel = new PicturesModel();
		$picturesGardensModel = new PicturesGardensModel();
	

		if(isset('delete-garden')){
			// Récupération de l'id du jardin
			$id = $_GET['id'];

			//sélection des photos sur la base de l'ID
			$pictures = $picturesModel->findAll($id);

			//Boucle pour supprimer les fichiers images sur le serveur
			foreach($pictures as $picture) {

				@unlink('uploads/' . $picture['URL']);
				@unlink('uploads/min/' . $picture['URL']);
			}

			// Suppression du jardin dans la base de données en commençant par les photos
			$pictures = $picturesModel->delete($id);

			$picturesGardens = $picturesGardensModel->delete($id);

			$gardens = $GardensModel->delete($id);

			$this->show('users/dashboard_mesjardins_manager', ['gardens' => $gardens, 'user' => $this->getUser()]);

		}

	}
		
}

	

