<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/ConnectionManager.php');

function listPosts()
{
    $postManager = new Forteroche\Blog\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
	
	if (isset($_SESSION['pseudo'])) {
		require('view/frontend/listPostsViewMember.php');
	}
	else {
		require('view/frontend/listPostsView.php');
	}
}

function newMember($pseudo, $pwd, $email)
{
	$connectionManager = new Forteroche\Blog\ConnectionManager(); // Création d'un objet
    $inserMember = $connectionManager->regMember($pseudo, $pwd, $email); // Appel d'une fonction de cet objet	
	if ($inserMember === false) {
        throw new Exception('Inscription impossible, le pseudo ' . $pseudo . ' n\'est pas disponible !');
    }
    else {
		echo ('Bonjour '. $pseudo . ', inscription réussi !');
		//require('view/frontend/listPostsView.php');
        //header('Location: index.php?action=connexion&pseudo=' . $pseudo&pass=);
    }
	
}

function connectionMember($pseudo, $pass_hache)
{
	$connectionManager = new Forteroche\Blog\ConnectionManager(); // Création d'un objet
	$retour = $connectionManager->connectMember($pseudo, $pass_hache);
	if ($retour) {
		echo ('Bonjour '. $pseudo . ', vous êtes connecté !');
		//require('view/frontend/listPostsView.php');
	}
	else
	{		
		throw new Exception('Mauvais identifiant ou mot de passe !');
	}
		
}