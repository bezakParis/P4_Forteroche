<?php

require_once("model/Manager.php");

class ConnectionManager extends Manager
{
	
    public function regMember($pseudo, $pass_hache, $email)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT COUNT(*) AS nbr FROM p4_members WHERE pseudo=:var_pseudo');
		$exist->execute(array(
			'var_pseudo' => $pseudo));
		$donnees = $exist->fetch();
		$exist->closeCursor();
		$resultat=false;
		if ($donnees['nbr'] == 0) { // si pseudo inexistant dans la table insertion
			$ajoutMember = $db->prepare('INSERT INTO p4_members(pseudo, droit, pass, email, registration_date) VALUES(:pseudo, :droit, :pass, :email, NOW())');
			$ajoutMember->execute(array(
							'pseudo' => $pseudo,
							'droit' => 0,
							'pass' => $pass_hache,
							'email' => $email));
			$resultat = true;
		}				
		return $resultat;
    }
	
	public function connectMember($pseudo, $pass_hache)
	{
		$db = $this->dbConnect();
		//recuperation user selectionner
		$req = $db->prepare('SELECT * FROM p4_members WHERE pseudo=:var_pseudo');
		$req->execute(array(
			'var_pseudo' => $pseudo));
		$resultat = $req->fetch();

		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($pass_hache, $resultat['pass']);

		if (!$resultat)
		{
			$req->closeCursor();
			return $resultat;
		}
		else
		{
			if ($isPasswordCorrect) {
				$req->closeCursor();
				return $resultat;
			}
			else {
				$req->closeCursor();
				return $resultat;
			}
		}
    }
	
	
}