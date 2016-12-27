<?php

namespace Model;

use \W\Model\UserModel;

class UsersModel extends Model
{

	public function findOwnerInfos(){
		$sql =<<< EOT
SELECT pseudo, URL
FROM users
LEFT JOIN gardens ON gardens.id_user = users.id
WHERE gardens.id = 1;

EOT;
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
