<?php

namespace Controller;


use \W\Controller\Controller;
use Model\PicturesModel;

class PictureController extends Controller
{
	public function details($id)

	{
		$picturesModel = new PicturesModel();
		$picture = $picturesModel->find($id); // Va cibler la colonne `id` de la base de données
		$this->show('picture/details', ['picture' => $picture]);
	}
}


// $this->allowTo(['user', 'admin']);



// $id contient l'ID entré dans l'url