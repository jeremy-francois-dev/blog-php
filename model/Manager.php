<?php

// Connexion to the database

namespace projetphp\model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('', '', '');
        return $db;
    }
}
/* */