<?php
/* ORM */
/* Utilisation des * dans les requêtes de l'ORM pour augmenter la maintenabilité du code */

namespace Projet\Models;

require('vendor/autoload.php');

if ($_SERVER['HTTP_HOST'] != "serveur.com") {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
}

use Exception;

abstract class Manager
{
    
    //Singleton  --- permet de définir qu'une fois le pdo et optimiser l'accès à la bdd
    private static $bdd = null;
    //méthode de connexion à la bdd
    protected static function dbConnect()
    {
        if (isset(self::$bdd)) {
            return self::$bdd;
        } else {
            try {
                self::$bdd = new \PDO(
                    "mysql:dbname=" . $_ENV['DB_NAME'] . "; charset=utf8; host="  . $_ENV['DB_HOST'] . ":" . $_ENV['DB_PORT'], //path
                    $_ENV['DB_USERNAME'],
                    $_ENV['DB_PASSWORD']
                );
                return self::$bdd;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }
    // méthode de l'ORM pour récupérer toutes les données d'une classe instanciée
    public static function all()
    {
        $objects = [];
        // permet de récupérer la class instanciée et de la transformer en string pour l'utiliser comme nom de table dans la requête
        $klass =  get_called_class();
        // traitement de la chaîne de caractère pour enlever le namespace et passer le nom de class seul dans la variable child
        $child = explode("\\",$klass);
        $child = strtolower($child[array_key_last($child)]);

        $sqlQuery = "SELECT * FROM `{$child}`";
    
        foreach (self::dbConnect()->query($sqlQuery) as $data) {
            array_push(
                $objects,
                new $klass($data)
            );
        }
        return $objects;
    }
    public static function exist($name, $value)
    {
        $klass =  get_called_class();
        $child = explode("\\",$klass);
        $child = strtolower($child[array_key_last($child)]);

    
        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("SELECT `{$name}` FROM `{$child}` WHERE `{$name}` = ?");
        $sqlQuery->execute(array($value));
        $result = $sqlQuery->fetch();
        if ($result){
            return true;
        }else{
            return false;
        }
    }
    public static function find($name, $value){
        $klass =  get_called_class();
        $child = explode("\\",$klass);
        $child = strtolower($child[array_key_last($child)]);


        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("SELECT * FROM `{$child}` WHERE `{$name}` = ?");
        $sqlQuery->execute(array($value));
        $result = $sqlQuery->fetch();
        return $result;
    }
}
