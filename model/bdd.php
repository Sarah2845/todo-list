<?php

include_once('../BddConfig.php');

class Bdd
{
    public static function connexion()
    {
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

            // La connexion a réussi
            //echo "Connexion à la base de données réussie!";
            return $pdo;

        } catch (Exception $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());

            //return $e->getMessage();
        }
    }
}

//$connexion = Bdd::connexion();