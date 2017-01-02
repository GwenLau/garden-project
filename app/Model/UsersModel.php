<?php

namespace Model;

use \W\Model\UsersModel;

class UsersModel extends Model
{	

	public function updateEmail($id_user, $email)
	{
		$sql = 'UPDATE users SET email = :email WHERE users.id = :id_user';
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
	}

	public function updatePassword($id_user, $password)
	{
		$sql = 'UPDATE users SET password = :password WHERE users.id = :id_user';
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
	}

}
