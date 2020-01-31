<?php
// Loading classes
require_once('model/AdministrationManager.php');    
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

// Function for the connexion of the Admin
function connexionAdministrator($adminPseudo)
{
    $administrationManager = new \projetphp\model\AdministrationManager();
    $administrator = $administrationManager->adminConnexion($adminPseudo);
    
    return $administrator;
}

// Function for show all the posts and the marked comments in the BACKEND
function postsAdmin()
{
    $postManager = new \projetphp\model\PostManager();
    $posts = $postManager->getPosts();

    $commentManager = new \projetphp\model\CommentManager();
    $comments = $commentManager->getMarkedComments();

    require('view/administrationView.php');
}

// Function for unmark a comment
function unmarkComment($commentId)
{
    $commentManager = new \projetphp\model\CommentManager();
    $affectedLines = $commentManager->unmarkComments($commentId);

    if ($affectedLines === false) {
        throw new Exception('Le signalement du commentaire ne peut être retiré !');
    }
    else {
        header('Location: index.php');
    }
}

// Function for delete a comment
function deleteComment($commentId)
{
    $commentManager = new \projetphp\model\CommentManager();
    $affectedLines = $commentManager->deleteComments($commentId);

    if ($affectedLines === false) {
        throw new Exception('Le commentaire ne peut être supprimé !');
    }
    else {
        header('Location: index.php');
    }
}

// Function for delete a post
function deletePost($postId)
{
    $postManager = new \projetphp\model\PostManager();
    $affectedLines = $postManager->deletePosts($postId);

    if ($affectedLines === false) {
        throw new Exception('L\'article ne peut être supprimé !');
    }
    else {
        header('Location: index.php');
    }
}

// Function for add a post
function addPost($title, $content)
{
    $postManager = new \projetphp\model\PostManager();

    $affectedLines = $postManager->postNewPost($title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter l\'article!');
    }
    else {
        header('Location: index.php');
    }
}

// Function for go to the page for update a post
function goToTiny()
{
   
    $postManager = new \projetphp\model\PostManager();
    $post = $postManager->getPost($_GET['id']);

    require('view/tinyView.php');
}

// Function for update a post
function updatePost($postId, $title, $content, $postSelectedId)
{
    $postManager = new \projetphp\model\PostManager();
    $affectedLines = $postManager->updatePosts($postId, $title, $content, $postSelectedId);

    if ($affectedLines === false) {
        throw new Exception('Impossible de mettre à jour l\'article !');
    }
    else {
        header('Location: index.php');
    }
   
}

function sessionDestroy()
{
    session_start();
    session_destroy();
    unset($_SESSION);
    header('Location: index.php');
    
}

