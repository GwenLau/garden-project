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
		//$this->allowTo(['user', 'admin']);
		// $mode : soit sort-City, soit sort-city

		// Récupère les jardins
		// Il nous faut le modèle pour cela :
		$gardensModel = new GardensModel();

		$gardens = $gardensModel->findAll();
		

		//$role = $this->getUser()['role'];

		$this->show('gardens/all', ['allGardens' => $gardens, 'user' => $this->getUser()]);
	}

	// Détails d'une image
	public function details($id)
	{
		$this->allowTo(['user', 'admin']);
		// $id contient l'ID entré dans l'url 
		$gardensModel = new GardensModel();
		$garden = $gardensModel->find($id); // Va cibler automatiquement la colonne `id` de la base de données
		$this->show('garden_details', ['garden' => $garden]);
	}

	public function displayAllInMap()
	{
		$gardensModel = new GardensModel();

		$gardens = $gardensModel->findAll();

		echo json_encode($gardens);
	}

	
	public function addGarden()
	{

		print_r($_FILES);
		// $this->allowTo('admin');
		$gardensModel = new GardensModel();
		$picturesModel = new PicturesModel();
		$picturesGardensModel = new PicturesGardensModel();
		$imageManagerService = new ImageManagerService();

		$errors = [];
		$fileNames = [];

		if(isset($_POST['add-garden'])) {
		

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
			            foreach ($fileNames as $fileName){
				            do {
				                $fileName = $shaFile . $nbFiles . '.' . $extFoundInArray;
				                $fullPath = $path . $fileName;
				                $nbFiles++;
			            	} while(file_exists($fullPath));
		            	}

			            if(count($errors) === 0) {
			            
			                $moved = move_uploaded_file($_FILES['my-file']['tmp_name'][$i], $fullPath);
			                if (!$moved) {
			                    $errors['my-file'][$i] = 'Erreur lors de l\'enregistrement';
			                } else {			

				                $imageManagerService->resize($fullPath, null, 200, 200, true, $path . 'min/' . $fileName, false);	
			            	}
			            }
	        		}
	    		} // fin si fichier present
    		}
    		// end loop
			
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
					'id_user'		=> $_SESSION['user_id'],
					'Name'	 		=> $_POST['name'],
					'Description' 	=> $_POST['description'],
					'Streetnumber'	=> $_POST['streetnumber'],
					'Streetname'	=> $_POST['streetname'],
					'CityCode	'	=> $_POST['citycode'],
					'City'			=> $_POST['city'],					
					'Name'	 		=> $_POST['name'],
					'lat'			=> $lat,
					'lng'			=> $lng,
				]);

				foreach($fileNames as $fileName) {
					$picturesModel->insert([
						'id_user'		=> $_SESSION['user_id'],
						'URL'			=> $fileName,			
					]);

					$picturesGardensModel->insert([
						'id_picture'	=> 'id_picture',
						'id_garden'		=> 'id_garden',
					]);
				}
	
			}
		}
		$this->show('users/dashboard_mesjardins', ['errors' => $errors]);
	}
}
	

	