<?php

namespace Model;

use \W\Model\Model;

class GardensModel extends Model

{
		public function findAllAndChilds()
	{
		$sql =<<< EOT
SELECT gardens.id AS gardenId, Description, Streetname, CityCode, Streetnumber, City, Name, gardens.id_user, URL, ALT,
FROM gardens
LEFT JOIN users ON users.id = gardens.id_user
INNER JOIN pictures_gardens ON pictures_gardens.id_garden = gardens.id
INNER JOIN pictures ON pictures.id = pictures_gardens.id_picture

EOT;
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function searchAllAndChilds($search)
	{
		$where = '';
		foreach($search as $key => $value){
			$where .= " `$key` LIKE :$key OR";
		}
		$where = substr($where, 0, -3);

		$sql =<<<EOT
SELECT gardens.id AS gardenId, Description, Streetname, CityCode, Streetnumber, City, Name, gardens.id_user
FROM gardens
LEFT JOIN users ON users.id = gardens.id_user
INNER JOIN pictures_gardens ON pictures_gardens.id_garden = gardens.id
INNER JOIN pictures ON pictures.id = pictures_gardens.id_picture
WHERE $where

EOT;

		$stmt = $this->dbh->prepare($sql);

		foreach($search as $key => $value){
			$stmt->bindValue(':'.$key, '%'.$value.'%');
		}

		$stmt->execute();
		return $stmt->fetchAll();
	}

	


}