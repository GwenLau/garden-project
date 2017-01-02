<?php

namespace Model;

use \W\Model\Model;

class GardensModel extends Model

{

		public function findAllAndChilds()
	{
		$sql =<<< EOT
SELECT gardens.id AS gardenId, Description, Streetname, CityCode, Streetnumber, City, Name, id_user
FROM gardens
LEFT JOIN users ON users.id = gardens.id_user
GROUP BY gardens.id
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
SELECT gardens.id AS gardenId, Description, Streetname, CityCode, Streetnumber, City, Name, id_user
FROM gardens
LEFT JOIN users ON users.id = gardens.id_user
WHERE $where
GROUP BY gardens.id
EOT;

		$stmt = $this->dbh->prepare($sql);

		foreach($search as $key => $value){
			$stmt->bindValue(':'.$key, '%'.$value.'%');
		}

		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function listOfGardens($id_user)
	{
		$sql = 'SELECT id, Name, City FROM gardens WHERE id_user = 6';
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(':id_user', $id_user);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function deleteGarden($id)
	{
		$sql = 'DELETE FROM gardens, pictures, pictures_gardens WHERE gardens.id = pictures_gardens.id_garden AND pictures.id = pictures_gardens.id_picture';
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}


	


}