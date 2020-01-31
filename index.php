<?php
session_start(); 
require('controller/frontend.php');
require('controller/backend.php');

try {
    if (isset($_GET['action'])) {
        //FRONTEND
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
            
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                  // Error ; we send everything to the catch
                  throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Another exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Another exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'markComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                markComment($_GET['id']);
            }
            else {
                // Another exception
                throw new Exception('Aucun ID de commentaire disponible');
            }
        }

        //BACKEND   
        elseif ($_GET['action'] == 'connexion') {
            if (isset($_POST['pseudo']) && isset($_POST['userPass'])) {
                $administrator = connexionAdministrator($_POST['pseudo']);
                $isPasswordCorrect = password_verify($_POST['userPass'], $administrator['pass']);
                if ($isPasswordCorrect) {  
                    
                    $_SESSION['id'] = $administrator['id'];
                    $_SESSION['pseudo'] = $administrator['pseudo'];
                    postsAdmin();
                } else {
                    throw new Exception('Identifiant ou mot de passe incorrect');
                }
               
            }
            else {
                // Another exception
                throw new Exception('Tous les champs ne sont pas remplis');
            }                   
        }
        elseif ($_GET['action'] == 'login') {
            if($_SESSION['id'] == 1) {
                postsAdmin();    
            }
            else {
                // Another exception
                throw new Exception('Impossible de se connecter');
            } 
        }

        elseif ($_GET['action'] == 'unmarkComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                unmarkComment($_GET['id']);
            }
            else {
                // Another exception
                throw new Exception('Aucun ID de commentaire disponible');
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
            else {
                // Another exception
                throw new Exception('Aucun ID de commentaire disponible');
            }
        }
        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
            }
            else {
                // Another exception
                throw new Exception('Aucun ID de commentaire disponible');
            }
        }
        elseif ($_GET['action'] == 'addPost') {
                if (!empty($_POST['title']) && !empty($_POST['mytextarea'])) {
                    addPost($_POST['title'], $_POST['mytextarea']);
                }
                else {
                    // Another exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        elseif ($_GET['action'] == 'goToTiny') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                goToTiny();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        }
        elseif ($_GET['action'] == 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                    updatePost($_GET['id'], $_POST['title'], $_POST['mytextarea'], $_GET['id']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
 
            if ($_GET['action'] == 'logout') {
                sessionDestroy();
            }                   
    }
        else {
            listPosts();
        } 
    }
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}