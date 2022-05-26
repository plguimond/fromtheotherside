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

        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("SELECT * FROM `{$child}`");
        $sqlQuery->execute();
        $result = $sqlQuery->fetchAll();
    
        foreach ($result as $data) {
            array_push(
                $objects,
                new $klass($data)
            );
        }
        return $objects;
    }

    //permet de vérifié si une valeur existe dans une table
    //name est me nom de la colonne et value la valeur que l'on cherche
    //retourne un booleen 
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
/* utilisation de * pour récupérer les données de n'importe qu'elle classe */

//cherche dans la la table une valeur de son choix 
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

    //récupère tous les résultats dans une table selon une valeur
    public static function findAll($name, $value){
        $klass =  get_called_class();
        $child = explode("\\",$klass);
        $child = strtolower($child[array_key_last($child)]);

        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("SELECT * FROM `{$child}` WHERE `{$name}` = ?");
        $sqlQuery->execute(array($value));
        $result = $sqlQuery->fetchAll();
        return $result;
    }

    //Retourne le nombre de ligne dans une table de la bdd
    public static function count(){
        $klass =  get_called_class();
        $child = explode("\\",$klass);
        $child = strtolower($child[array_key_last($child)]);

        $bdd = self::dbConnect();
        $sqlQuery = $bdd->prepare("SELECT COUNT(id) AS number_of FROM `{$child}`");
        $sqlQuery->execute();
        $result = $sqlQuery->fetch();
        return $result;
    }

    //permet de supprimer un élément de la bdd selon une valeur
    public static function delete($name, $value){
        $klass =  get_called_class();
        $child = explode("\\",$klass);
        $child = strtolower($child[array_key_last($child)]);
        
        $bdd = self::dbConnect();
        $req = $bdd->prepare("DELETE FROM `{$child}` WHERE `{$name}` = ?");
        $req->execute(array($value)); 
    }

    
}
