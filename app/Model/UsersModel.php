<?php

namespace Model;

use \W\Model\UsersModel;

class UsersModel extends Model
{	

	public function updateAvatar(){
		$sql = 'UPDATE users SET avatar = '$fileName' WHERE users.id = $_SESSION['user']['id'];';
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':avatar', $fileName);
		$stmt->bindValue(':id_user', $_SESSION['user']['id']);
		$stmt->execute();
	}

}
