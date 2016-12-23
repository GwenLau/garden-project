<?php

namespace Model;

use \W\Model\Model;

class MessagesModel extends Model
{	
	public function findAllMessages($id_user)
	{
		$sql =<<< EOT
SELECT *
FROM messages
INNER JOIN users ON users.id = messages.id_send
WHERE id_receive = :id_user 

EOT;
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(':id_user', $id_user);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}