<?php

// Chargement des classes
require_once('model/PostManager.php');

function listPosts()
{
    $postManager = new Forteroche\Blog\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}