<?php

namespace Model;

use \W\Model\Model;


class GardensModel extends Model
{
		public function findPictures()
	
	{
		$sql =<<< EOT
		SELECT * 
		FROM pictures_gardens
		INNER JOIN pictures on pictures.id = pictures_gardens.id_picture
		WHERE pictures_gardens.id_garden = 1

EOT;

	$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
		
}


	




