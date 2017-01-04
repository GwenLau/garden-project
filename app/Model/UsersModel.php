<?php

namespace Model;

use \W\Model\UsersModel;

class UsersModel extends Model
{	

	public function displayMyAccount(){
		$sql = 'SELECT * FROM users WHERE id_users = $_SESSION['user-id']';
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(':id_user', $SESSION['user-id'];
		$stmt->fetchAll();
	};

	// public function findOwnerInfos(){
	// $sql =<<< EOT
	// 	SELECT pseudo, avatar
	// 	FROM users
	// 	LEFT JOIN gardens ON gardens.id_user = users.id
	// 	WHERE gardens.id = users.id;

	// EOT;
	// $stmt = $this->dbh->prepare($sql);
	// $stmt->execute();
	// return $stmt->fetchAll();
	// }
}
