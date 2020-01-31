<?php

// Loading classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

// Function for show the list of all the posts
function listPosts()
{
    $postManager = new \projetphp\model\PostManager();
    $posts = $postManager->getPosts();

    require('view/listPostsView.php');
}

// Function for show one selected post with all its comments
function post()
{
    $postManager = new \projetphp\model\PostManager();
    $post = $postManager->getPost($_GET['id']);

    $commentManager = new \projetphp\model\CommentManager();
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

// Function for add a comment
function addComment($postId, $author, $comment)
{
    $commentManager = new \projetphp\model\CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

// Function for mark a comment
function markComment($commentId)
{
    $commentManager = new \projetphp\model\CommentManager();
    $affectedLines = $commentManager->markComments($commentId);

    if ($affectedLines === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        header('Location: index.php');
    }
   
}