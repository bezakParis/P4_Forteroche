<?php


require_once("model/Manager.php");

class CommentManager extends Manager
{
   public function getComments($postId)
    {/*
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, member_id, comment, moderate, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM p4_comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
	*/	
	
	/*
		$db = $this->dbConnect();
        $comments = $db->prepare('SELECT c.id AS c_id, m.pseudo AS m_pseudo, c.comment AS c_comment, c.moderate AS c_moderate, DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
		FROM p4_comments AS c
		INNER p4_members AS m
		ON c.member_id = m.id
		WHERE c.post_id = ?
		ORDER BY c.comment_date DESC');
        $comments->execute(array($postId));*/
	//echo ('$comments c_comment= ' .$comments['c_comment']);
	
	
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id AS c_id, member_id AS m_pseudo, comment AS c_comment, moderate AS c_moderate, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM p4_comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
		
		return $comments;
    }
	
	
   public function addComment($member_id, $comment, $post_id)
    {
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
	
	
   public function updateComment($comment_id)
    {
		$db = $this->dbConnect();
			
		$insert = $db->prepare('UPDATE p4_comments SET moderate=:moderate WHERE id=:comment_id');
		$insert->execute(array(
			'comment_id' => $comment_id,
			'moderate' => 1,
			));
		
		return $insert;	
    }
}