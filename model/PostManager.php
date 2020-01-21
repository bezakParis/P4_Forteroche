<?php

require_once("model/Manager.php");

class PostManager extends Manager {
	
	
    public function getPosts() {
		
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM p4_posts ORDER BY creation_date');
		
        return $req;
    }
	
	public function getAdminPosts() {
		
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM p4_posts ORDER BY creation_date DESC');
		
        return $req;
    }
	

    public function getPost($postId) {
	
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM p4_posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
	
	
	public function addPost($titre, $contenu) {
		
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO p4_posts (title, content, creation_date) VALUES(:p_titre, :p_contenu, NOW())');
		$req->execute(array(
				'p_titre' => $titre,
				'p_contenu' => $contenu));
				
        return $req;
	}
	
	
	public function updatePost($id, $titre, $contenu) {
		
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE p4_posts SET title=:p_titre, content=:p_contenu WHERE id=:p_id');
		$req->execute(array(
				'p_id' => $id,
				'p_titre' => $titre,
				'p_contenu' => $contenu));
				
        return $req;
	}
	
	
	public function removePost($id) {
		
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM p4_posts WHERE id= ?');
		$req->execute(array($id));
		
		return $req;
	}
}