<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/ConnectionManager.php');

function adminAcces()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
	require('view/backend/adminView.php');
}


function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
	session_start();
	if (isset($_SESSION['pseudo'])) {
		require('view/frontend/listPostsMemberView.php');
	}
	else {
		require('view/frontend/listPostsView.php');
	}
}

function newMember($pseudo, $pass_hache, $email)
{
	$connectionManager = new ConnectionManager(); // Création d'un objet
    $inserMember = $connectionManager->regMember($pseudo, $pass_hache, $email); // Appel d'une fonction de cet objet	
	if ($inserMember === false) {
        throw new Exception('Inscription impossible, le pseudo ' . $pseudo . ' n\'est pas disponible !');
    }
    else {
		//echo ('Bonjour '. $pseudo . ', inscription réussi !');
		//require('view/frontend/listPostsView.php');
        connectionMember($pseudo, $pass_hache);
    }
	
}

function connectionMember($pseudo, $pass_hache)
{
	$connectionManager = new ConnectionManager(); // Création d'un objet
	$retour = $connectionManager->connectMember($pseudo, $pass_hache);
	if ($retour) {
		session_start();
		$_SESSION['pseudo'] = $pseudo;
		if ($retour['droit'] == 0) {
			listPosts();
		}
		else {
			//echo ('Bonjour '. $_SESSION['pseudo'] . ', vous êtes connecté !');
			adminAcces();
		}
	}
	else
	{		
		throw new Exception('Mauvais identifiant ou mot de passe !');
	}
		
}

function deconnectionMember()
{
	session_start();
	// Suppression des variables de session et de la session
	$_SESSION = array();
	session_destroy();
	require('view/frontend/confirmDeconnexionView.php');
}