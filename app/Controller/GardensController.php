<?php

namespace Controller;

use \W\Controller\Controller;
use Service\ImageManagerService;
use Model\GardensModel;

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

		// Start XML file, create parent node
		$doc = domxml_new_doc("1.0");
		$node = $doc->create_element("markers");
		$parnode = $doc->append_child($node);

		// Opens a connection to a MySQL server
		// $connection=mysql_connect ('localhost', $username, $password);
		// if (!$connection) {
		//  die('Not connected : ' . mysql_error());
		// }

		// Set the active MySQL database
		// $db_selected = mysql_select_db($database, $connection);
		// if (!$db_selected) {
		//  die ('Can\'t use db : ' . mysql_error());
		// }

		// Select all the rows in the markers table
		// $query = "SELECT * FROM markers WHERE 1";
		// $result = mysql_query($query);
		// if (!$result) {
		//  die('Invalid query: ' . mysql_error());
		// }

		header("Content-type: text/xml");

		// Iterate through the rows, adding XML nodes for each
		while ($row = @mysql_fetch_assoc($gardens)){
			// Add to XML document node
			$node = $doc->create_element("marker");
			$newnode = $parnode->append_child($node);

			$newnode->set_attribute("Name", $row['Name']);
			// $newnode->set_attribute("address", $row['address']);
			$newnode->set_attribute("lat", $row['lat']);
			$newnode->set_attribute("lng", $row['lng']);
			// $newnode->set_attribute("type", $row['type']);
		}

			$xmlfile = $doc->dump_mem();
			echo $xmlfile;

	}



	
	public function addGarden()
	{
		// $this->allowTo('admin');
		$gardensModel = new GardensModel();
		$imageManagerService = new ImageManagerService();

		$errors = [];

		if(isset($_POST['add-garden'])) {
		

			if(empty($_POST['name']) || strlen($_POST['name']) < 5) {
				$errors['name']['emptyorshort'] = true;
			}
			if(empty($_POST['description']) || strlen($_POST['description']) < 10) {
				$errors['description']['emptyorshort'] = true;
			}
			if(empty($_POST['streetname'])) {
				$errors['streetname']['emptyorshort'] = true;
			}
			//if(empty($_POST['citycode']) || preg_match("[0-9]{5}", $_POST['citycode']) = false) {
			//	$errors['citycode']['emptyorfalse'] = true;
			//}
			if(empty($_POST['city']) || strlen($_POST['city']) < 3) {
				$errors['city']['emptyorshort'] = true;
			}
			// Vérification du fichier uploadé
			if ($_FILES['my-file']['error'] != UPLOAD_ERR_OK) {
        
        		$errors['my-file'] = 'Merci de choisir un fichier';
    		} else {
	        	$finfo = new \finfo(FILEINFO_MIME_TYPE);
	        	// Récupération du Mime
	        	$mimeType = $finfo->file($_FILES['my-file']['tmp_name']);
	        	$extFoundInArray = array_search(
	            	$mimeType, array(
		                'jpg' => 'image/jpeg',
		                'png' => 'image/png',
		                'gif' => 'image/gif',
	            	)
	        	);
	        	if ($extFoundInArray === false) {
	            	$errors['my-file'] =  'Le fichier n\'est pas une image';
	        	} else {
	            // Renommer nom du fichier
		            $shaFile = sha1_file($_FILES['my-file']['tmp_name']);
		            $nbFiles = 0;
		            $path = './assets/uploads/';
		            $fileName = ''; // Le nom du fichier, sans le dossier
		            do {
		                $fileName = $shaFile . $nbFiles . '.' . $extFoundInArray;
		                $fullPath = $path . $fileName;
		                $nbFiles++;
	            	} while(file_exists($fullPath));

		            if(count($errors) === 0) {
		            
		                $moved = move_uploaded_file($_FILES['my-file']['tmp_name'], $fullPath);
		                if (!$moved) {
		                    $errors['my-file'] = 'Erreur lors de l\'enregistrement';
		                } else {			

			                $imageManagerService->resize($fullPath, null, 200, 200, true, $path . 'min/' . $fileName, false);	
		            	}
		            }
        		}
    		}
			
			if(count($errors) === 0) {
				$url = 'https://maps.googleapis.com/maps/api/geocode/json?';

				$urlParams = http_build_query([
				    'address' => $_POST['streetnumber'] . $_POST['streetname'] . $_POST['citycode'] . $_POST['city'],
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
					'URL'			=> $fileName,
					'lat'			=> $lat,
					'lng'			=> $lng,
				]);

	
			}
		}
		$this->show('users/dashboard_mesjardins', ['errors' => $errors]);
	}
}
	

	