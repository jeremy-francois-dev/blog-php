<?php

namespace projetphp\model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    // Get all the comments from a selected post
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    // Post a new comment
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, marked) VALUES(?, ?, ?, NOW(), false)');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    // Get all the comments marked by users
    public function getMarkedComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE marked IS NOT false ORDER BY comment_date DESC');
        
        return $comments;
    }
    //Mark a comment in the FRONTEND interface
    public function markComments($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET marked = true WHERE id = ?');
        $affectedLines = $comments->execute(array($commentId));

        return $affectedLines;
    }
    //Unmark a comment
    public function unmarkComments($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET marked = false WHERE id = ?');
        $affectedLines = $comments->execute(array($commentId));

        return $affectedLines;
    }
    //Delete a comment
    public function deleteComments($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedLines = $comments->execute(array($commentId));

        return $affectedLines;
    }
}