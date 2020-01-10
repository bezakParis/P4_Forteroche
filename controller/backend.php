<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/ConnectionManager.php');

function postAdmin()
{	
	session_start();
	if ($_SESSION['droit']) {
		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$post = $postManager->getPost($_GET['id']);
		$comments = $commentManager->getComments($_GET['id']);

		require('view/backend/postAdminView.php');
		
	}else {
		throw new Exception('Non authorisé !');
	}
	
}