<?php

namespace Controller;

use Model\PicturesModel;
use \W\Controller\Controller;

class PictureController extends Controller
{	

	public function addPicture()
	{
		// $this->allowTo('admin');
		$picturesModel = new PicturesModel();

		if(isset($_POST['add-image'])) {
			$errors = [];

			if(empty($_POST['title'])) {
				$errors['title']['empty'] = true;
			}
			if(empty($_POST['description'])) {
				$errors['description']['empty'] = true;
			}

			if(empty($_POST['localisation'])) {
				$errors['localisation']['empty'] = true;
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
		            $fileName = ''; // Le nom du fichier, sans le dossier
		            do {
		                $fileName = $shaFile . $nbFiles . '.' . $extFoundInArray;
		                $fullPath = './assets/uploads/' . $fileName;
		                $nbFiles++;
	            	} while(file_exists($fullPath));


		            if(count($errors) == 0) {
		                // insert($fullPath, $_POST['title'], $_POST['description']);
		                $moved = move_uploaded_file($_FILES['my-file']['tmp_name'], $fullPath);
		                if (!$moved) {
		                    $errors['my-file'] = 'Erreur lors de l\'enregistrement';

		                }
		            }
        		}
    		}
			

			if(count($errors) === 0) {
				$picturesModel->insert([
					'id_user'		=> '1', // à remplacer par $_SESSION['user_id']
					'Name' 			=> $_POST['title'],
					'Description' 	=> $_POST['description'],
					'URL'			=> $fileName,
					'City' 			=> $_POST['localisation'],
				]);
				$this->show('pictures/add-picture', ['errors' => $errors]);
			}
		}

		$this->show('pictures/add-picture');
	}
}

	