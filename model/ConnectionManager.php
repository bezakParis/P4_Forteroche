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
		$resultat=false;
		if ($donnees['nbr'] == 0) { // si pseudo inexistant dans la table insertion
			$ajoutMember = $db->prepare('INSERT INTO p4_members(pseudo, droit, pass, email, registration_date) VALUES(:pseudo, :droit, :pass, :email, NOW)');
			$resultat = $ajoutMember->execute(array(
										'pseudo' => $pseudo,
										'droit' => 0,
										'pass' => $pwd,
										'email' => $email));
		}				
		return $resultat;
    }
	
	
	
	
}