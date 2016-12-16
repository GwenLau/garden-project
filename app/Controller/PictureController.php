<?php

namespace Controller;


use \W\Controller\Controller;
use Service\ImageManagerService;
use Model\PicturesModel;

class PictureController extends Controller
{
	// Affichage de la liste des images
	public function displayAll()
	{
		//$this->allowTo(['user', 'admin']);
		// $mode : soit sort-City, soit sort-city

		// Récupère les images
		// Il nous faut le modèle pour cela :
		$picturesModel = new PicturesModel();


		$pictures = $picturesModel->findAll('Description');
		

		//$role = $this->getUser()['role'];

		$this->show('picture/all', ['allPictures' => $pictures]);
	}

	// Détails d'une image
	public function details($id)
	{
		$this->allowTo(['user', 'admin']);
		// $id contient l'ID entré dans l'url 
		$picturesModel = new PicturesModel();
		$picture = $picturesModel->find($id); // Va cibler automatiquement la colonne `id` de la base de données
		$this->show('picture/details', ['picture' => $picture]);
	}

	
	public function addPicture()
	{
		// $this->allowTo('admin');
		$picturesModel = new PicturesModel();
		$imageManagerService = new ImageManagerService();

		$errors = [];

		if(isset($_POST['add-image'])) {
		

			if(empty($_POST['title']) || strlen($_POST['title']) < 10) {
				$errors['title']['emptyorshort'] = true;
			}
			if(empty($_POST['description']) || strlen($_POST['description']) < 10) {
				$errors['description']['emptyorshort'] = true;
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
				$picturesModel->insert([
					'id_user'		=> '1', // à remplacer par $_SESSION['user_id']
					'Name' 			=> $_POST['title'],
					'Description' 	=> $_POST['description'],
					'URL'			=> $fileName,
					'City' 			=> $_POST['localisation'],
				]);

	
			}
		}
		$this->show('pictures/add-picture', ['errors' => $errors]);
	}

	    public function like()
    {
 
        $sql = 'INSERT INTO VALUES(:nbVotes)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nbVotes', $row->getIdOrder(), \PDO::PARAM_INT);

    }
}
