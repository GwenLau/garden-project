<!-- 
<?php

namespace Controller;

use Model\PlacesModel;
use \W\Controller\Controller;

class PlaceController extends Controller
{
	public function __destruct()
	{
		unset($_SESSION[isset($_SESSION['preserve-flash']) ? 'preserve-flash' : 'flash']);
	}
	
	/**
	 * Retourne en JSON les emplacements correspondant à la recherche $_POST['s']
	 * @see public/assets/script.js
	 */
	public function search()
	{
		if(isset($_GET['s'])) {
			$placesModel = new PlacesModel();
			$places = $placesModel->search(['city' => $_GET['s']], 'OR', false); // no strip_tags (inutile)
			foreach ($places as $place) {
				$autocomplete [] = [
					'label'	=> $place['city'],
					'value'	=> $place['id'],
				];
			}
			$this->showJson($autocomplete);
		}
	}
} -->