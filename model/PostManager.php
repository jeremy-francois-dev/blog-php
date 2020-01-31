<?php

namespace projetphp\model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    // Get all the posts
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    // Get a selected post
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // Post a new post
    public function postNewPost($title, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $affectedLines = $posts->execute(array($title, $content));

        return $affectedLines;
    }

    // Delete a post
    public function deletePosts($postId)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $posts->execute(array($postId));

        return $affectedLines;
    }

    // Update a post
    public function updatePosts($postId, $title, $content, $postSelectedId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE posts SET id = ?, title = ?, content = ?, creation_date = NOW() WHERE id = ?');
        $affectedLines = $comments->execute(array($postId, $title, $content, $postSelectedId));

        return $affectedLines;
    }
}