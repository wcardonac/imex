<?php
//hacer la consiguracion para la conecxion ala base de datos
    class Database{
        private $host = 'localhost';
        private $database ='tienda_online';
        private $username = 'root';
        private $password = '';
        private $charset = 'utf8';

        //declaramos una funcion para 
        function conectar()
        {
            //con PDO hacemos la conexion a varias bases de datos
            try {
                //code...
                $conexion = "mysql:host=". $this->host.";dbname=". $this->database.";
                charset=". $this->charset;
                
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES=> false
                ];
                
                $pdo = new PDO ($conexion, $this->username,  $this->password,  $options );
                
                return $pdo;
            } catch (PDOException $e) {
               echo 'error de conexion' . $e->getMessage();
               exit;
            }
        }


    }







?>