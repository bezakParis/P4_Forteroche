<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/ConnectionManager.php');

function adminAcces()
{
    $postManager = new PostManager(); // Cr�ation d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
	require('view/backend/adminView.php');
}

function listPosts()
{
    $postManager = new PostManager(); // Cr�ation d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
	session_start();
	if (isset($_SESSION['pseudo']) AND $_SESSION['pseudo'] != "" 
				AND isset($_SESSION['droit']) AND $_SESSION['droit'] != "") {
		if ($_SESSION['droit'] == 1) {
			require('view/backend/adminView.php');
		}
		else {
			require('view/frontend/listPostsMemberView.php');
		}
		
	}
	else {
		require('view/frontend/listPostsView.php');
	}
}


function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
	
    require('view/frontend/postView.php');
	
}

function ajouterCommentaire($comment, $post_id)
{
	$postManager = new PostManager();
    $commentManager = new CommentManager();
	
	session_start();
    $comment = $commentManager->addComment($_SESSION['member_id'], $comment, $post_id);
	if ($comment === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !'); 
    }
    else {
        header('Location: index.php?action=post&id=' . $post_id); 
    }
}



function newMember($pseudo, $pass_hache, $email)
{
	$connectionManager = new ConnectionManager(); // Cr�ation d'un objet
    $inserMember = $connectionManager->regMember($pseudo, $pass_hache, $email); // Appel d'une fonction de cet objet	
	if ($inserMember === false) {
        throw new Exception('Inscription impossible, le pseudo ' . $pseudo . ' n\'est pas disponible !');
    }
    else {
		//echo ('Bonjour '. $pseudo . ', inscription r�ussi !');
		//require('view/frontend/listPostsView.php');
        connectionMember($pseudo, $pass_hache);
    }
	
}

function connectionMember($pseudo, $pass_hache)
{
	$connectionManager = new ConnectionManager(); // Cr�ation d'un objet
	$retour = $connectionManager->connectMember($pseudo, $pass_hache);
	if ($retour) {
		session_start();
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['member_id'] = $retour['id'];
		$_SESSION['droit'] = $retour['droit'];
		if ($retour['droit'] == 0) { //utilisateur simple = 0 admin = 1
			listPosts();
			//echo ('via SESSION  :  pseudo = '.$_SESSION['pseudo'] . ' - droit = ' . $_SESSION['droit'] . ' - ID = ' . $_SESSION['member_id']);
		}
		else {
			//echo ('Bonjour '. $_SESSION['pseudo'] . ', vous �tes connect� !');
			adminAcces();
		}
	}
	else
	{		
		throw new Exception('Mauvais identifiant ou mot de passe !');
	}
		
}


function signalerComment($comment_id, $post_id)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
	
	session_start();
    $comment = $commentManager->updateComment($comment_id);
	if ($comment === false) {
        throw new Exception('Impossible de signaler le commentaire !'); 
    }
    else {
        header('Location: index.php?action=post&id=' . $post_id); 
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