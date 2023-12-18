<?php

define('DB_HOST', '51.158.59.186');
define('DB_USER', 'phppex');
define('DB_PASSWORD', 'Supermotdepasse!42');
define('DB_PORT', '14301');
define('DB_NAME', 'SO');

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