<?php


require_once("model/Manager.php");

class CommentManager extends Manager
{
   public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, pseudo, comment, moderate, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM p4_comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
	
	
   public function addComment($pseudo, $comment, $post_id)
    {
        $db = $this->dbConnect();
		$insert = $db->prepare('INSERT INTO p4_comments(post_id, pseudo, comment, moderate, comment_date) VALUES (:post_id, :pseudo, :comment, :moderate, NOW())');
		$insert->execute(array(
			'post_id' => $post_id,
			'pseudo' => $pseudo, 
			'comment' => $comment,
			'moderate' => 0,
			));		
    }
}