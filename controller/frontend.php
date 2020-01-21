<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/ConnectionManager.php');


function adminAcces() {
	
    $postManager = new PostManager();
    $posts = $postManager->getAdminPosts();
	
	require('view/backend/adminView.php');
}


function listPosts() {
	
    $postManager = new PostManager();
    //$posts = $postManager->getPosts();
	
	session_start();
	
	if (isset($_SESSION['pseudo']) AND $_SESSION['pseudo'] != "" 
				AND isset($_SESSION['droit']) AND $_SESSION['droit'] != "") {
					
		if ($_SESSION['droit'] == 1) {
			$posts = $postManager->getAdminPosts();
			require('view/backend/adminView.php');
		}
		else {
			$posts = $postManager->getPosts();
			require('view/frontend/listPostsMemberView.php');
		}
	}
	else {
		$posts = $postManager->getPosts();
		require('view/frontend/listPostsView.php');
	}
}


function post() {
	
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
	
    require('view/frontend/postView.php');
	
}


function ajouterCommentaire($comment, $post_id) {
	
	$postManager = new PostManager();
    $commentManager = new CommentManager();
	
	session_start();
	
    $comment = $commentManager->addComment($_SESSION['member_id'], $comment, $post_id);
	
	if ($comment === false) {
		
        throw new Exception('Impossible d\'ajouter le commentaire !'); 
    }
    else {
		
		if ($_SESSION['droit'] == 1) {
			
			header('Location: index.php?action=postAdmin&id=' . $post_id);
		}
		else {
			
			header('Location: index.php?action=post&id=' . $post_id);
		} 
    }
}


function newMember($pseudo, $pass, $email) {
	$connectionManager = new ConnectionManager(); // Création d'un objet
	
	$verifMember = $connectionManager->checkMember($pseudo);
	
	if ($verifMember['nbr'] == 0) {
		
		$req=$connectionManager->regMember($pseudo, $pass, $email);
		
			if (!$req) {
				
				throw new Exception('Inscription impossible, r&eacute;essayer plus tard !');
			}
			else {
				
				connectionMember($pseudo, $pass);
			}
	}
	else {
		
        throw new Exception('Inscription impossible, le pseudo ' . $pseudo . ' n\'est pas disponible !');
	}
}


function connectionMember($pseudo, $pass) {
	
	$connectionManager = new ConnectionManager(); // Création d'un objet
	$retour = $connectionManager->connectMember($pseudo);
	
	$isPasswordCorrect = password_verify($pass, $retour['pass']);
	
	if ($isPasswordCorrect) {
		
		session_start();
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['member_id'] = $retour['id'];
		$_SESSION['droit'] = $retour['droit'];
		
		if ($retour['droit'] == 0) { //utilisateur simple = 0 admin = 1
		
			listPosts();
		}
		else {
			
			adminAcces();
		}
	}
	else {
		
		throw new Exception('Mauvais identifiant<br />ou<br />mot de passe !');
	}
		
}

function signalerComment($comment_id, $post_id) {
	
    $postManager = new PostManager();
    $commentManager = new CommentManager();
	
	session_start();
    $comment = $commentManager->moderateComment($comment_id);
	
	if ($comment === false) {
		
        throw new Exception('Impossible de signaler le commentaire !'); 
    }
    else {
		
        header('Location: index.php?action=post&id=' . $post_id); 
    }
	
}


function deconnectionMember() {
	
	session_start();
	// Suppression des variables de session et de la session
	$_SESSION = array();
	session_destroy();
	
	require('view/frontend/confirmDeconnexionView.php');
}