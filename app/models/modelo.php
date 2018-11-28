<?php

class bbdd {

    
    public static function conectar() {

        try {
            
            $config = require_once 'config.php';

            $conexion = new PDO("mysql:host=".$config['host'].";dbname=".$config['database'],$config['user'], $config['pass']);

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $conexion->exec("SET CHARACTER SET UTF8");
            
            return $conexion;

        } catch (PDOException $ex) {

            die("Error" . $ex->getMessage()); 
           
        }
        
    }

}


?>

