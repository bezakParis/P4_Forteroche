<?php

require_once("model/Manager.php");

class ConnectionManager extends Manager
{
	
    public function checkMember($pseudo)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT COUNT(*) AS nbr FROM p4_members WHERE pseudo=:var_pseudo');
		$exist->execute(array(
			'var_pseudo' => $pseudo));
		$donnees = $exist->fetch();
		$exist->closeCursor();
		return $donnees;
    }
	
    public function regMember($pseudo, $pass, $email)
	{
		$db = $this->dbConnect();
		$pass_hache = password_hash($pass, PASSWORD_DEFAULT);
		$ajoutMember = $db->prepare('INSERT INTO p4_members(pseudo, droit, pass, email, registration_date) VALUES(:pseudo, :droit, :pass, :email, NOW())');
		$ajoutMember->execute(array(
						'pseudo' => $pseudo,
						'droit' => 0,
						'pass' => $pass_hache,
						'email' => $email));
		return $ajoutMember;
    }
	
	public function connectMember($pseudo)
	{	
		$db = $this->dbConnect();
		//recuperation user selectionner
		$req = $db->prepare('SELECT * FROM p4_members WHERE pseudo=:var_pseudo');
		$req->execute(array(
			'var_pseudo' => $pseudo));
		$resultat = $req->fetch();

		return $resultat;
    }
	
	
}