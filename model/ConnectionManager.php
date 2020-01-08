<?php

namespace Forteroche\Blog;

require_once("model/Manager.php");

class ConnectionManager extends Manager
{
	
     public function regMember($pseudo, $pwd, $email)
    {
        $db = $this->dbConnect();
		$exist = $db->prepare('SELECT COUNT(*) AS nbr FROM p4_members WHERE pseudo=:var_pseudo');
		$exist->execute(array(
			'var_pseudo' => $pseudo));
		$donnees = $exist->fetch();
		$exist->closeCursor();
		
		if ($donnees['nbr'] == 0) {
			$req = $db->prepare('INSERT INTO p4_members(pseudo, droit, pass, email, registration_date) VALUES(:pseudo, :droit, :pass, :email, CURDATE())');
			$req->execute(array(
				'pseudo' => $pseudo,
				'droit' => 0,
				'pass' => $pwd,
				'email' => $email));				
		}
		else {
			throw new Exception('pseudo existant ! '. $pseudo . 'Veuillez en choisir un autre');
		}
    }
	
	
	
	
}