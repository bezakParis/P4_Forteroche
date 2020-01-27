<?php

require_once("model/Manager.php");

class CommentManager extends Manager {
	
	public function getComments($postId) {	
	
		$db = $this->dbConnect();
        $comments = $db->prepare('SELECT c.id AS c_id, c.comment AS c_comment, c.moderate AS c_moderate,
										DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, m.pseudo AS m_pseudo
									FROM p4_comments AS c
									INNER JOIN p4_members AS m
									ON c.member_id = m.id
									WHERE c.post_id = ?
									ORDER BY c.comment_date DESC');
        $comments->execute(array($postId));
		
		return $comments;
    }
	
	public function listModerate() {	
	
		$db = $this->dbConnect(); // correctif du 26/01 ajouter champs c.post_id AS c_post_id
		
        $comments = $db->prepare('SELECT c.id AS c_id, c.comment AS c_comment, c.moderate AS c_moderate, c.post_id AS c_post_id,
										DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, m.pseudo AS m_pseudo
									FROM p4_comments AS c
									INNER JOIN p4_members AS m
									ON c.member_id = m.id
									WHERE c.moderate = ?
									ORDER BY c.comment_date DESC');
        $comments->execute(array(1));
		
		return $comments;
    }
	
	
	public function addComment($member_id, $comment, $post_id) {
		
		$db = $this->dbConnect();
		$insert = $db->prepare('INSERT INTO p4_comments(post_id, member_id, comment, moderate, comment_date) VALUES (:post_id, :member_id, :comment, :moderate, NOW())');
		$insert->execute(array(
			'post_id' => $post_id,
			'member_id' => $member_id, 
			'comment' => $comment,
			'moderate' => 0,
			));
		
		return $insert;
    }
	
	
	public function updateComment($id) {
		
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE p4_comments SET moderate=:moderate WHERE id=:comment_id');
		$req->execute(array(
			'comment_id' => $id,
			'moderate' => 0,
			));
		
		return $req;	
    }
	
	
	public function moderateComment($id) {
		
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE p4_comments SET moderate=:moderate WHERE id=:comment_id');
		$req->execute(array(
			'comment_id' => $id,
			'moderate' => 1,
			));
		
		return $req;	
    }
	
	public function removeComment($id) {
		
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM p4_comments WHERE id= ?');
		$req->execute(array($id));
		
		return $req;
	}
}