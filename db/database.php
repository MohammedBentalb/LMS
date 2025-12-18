<?php

    namespace Db;
    use PDO;
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "lms";

    $conn = mysqli_connect($servername, $username, $password, $dbName);

    if(!$conn){
        die("Connection failed" . mysqli_connect_error());
    }   

    
    class Database{
        private static ?PDO $connection = null;
        public static function getConnnection(){
            if(self::$connection == null){
                return self::$connection = new PDO("mysql:host=localhost;dbname=lms;charset=utf8mb4","root","", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            }
            return self::$connection;
        }
    }
