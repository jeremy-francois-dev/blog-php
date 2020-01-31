<?php

namespace projetphp\model;

require_once("model/Manager.php");

class AdministrationManager extends Manager
{
    
    // Admin connexion
    public function adminConnexion($adminPseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute(array($adminPseudo));
        $adminSession = $req->fetch();
        
        return $adminSession;
    }
}
   