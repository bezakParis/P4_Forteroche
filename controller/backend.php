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
	if ($post === false) {
        throw new Exception('Impossible d\'ajouter le post !'); 
    }
    else {
        header('Location: index.php?action=listPosts'); 
    }
}

function supprimerPost($id)
{
	$postManager = new PostManager();
	$post = $postManager->removePost($id);
	if ($post === false) {
        throw new Exception('Impossible de supprimer le post !'); 
    }
    else {
        header('Location: index.php?action=listPosts'); 
    }
}

function supprimerComment($id, $post_id)
{
	$commentManager = new CommentManager();
	$comment = $commentManager->removeComment($id);
	if ($comment === false) {
        throw new Exception('Impossible de supprimer le commentaire !'); 
    }
    else {
		header('Location: index.php?action=postAdmin&id=' . $post_id); 
    }
}

function accepterComment($id, $post_id)
{
	$commentManager = new CommentManager();
	$comment = $commentManager->updateComment($id);
	if ($comment === false) {
        throw new Exception('Impossible de modifier le statut du commentaire !'); 
    }
    else {
		header('Location: index.php?action=postAdmin&id=' . $post_id); 
    }
}