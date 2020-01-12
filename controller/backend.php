<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/ConnectionManager.php');

function postAdmin()
{	
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$post = $postManager->getPost($_GET['id']);
	$comments = $commentManager->getComments($_GET['id']);

	require('view/backend/postAdminView.php');
}


function ajouterPost($titre, $contenu)
{
	$postManager = new PostManager();
	$post = $postManager->addPost($titre, $contenu);
	header('Location: index.php?action=listPosts');
}