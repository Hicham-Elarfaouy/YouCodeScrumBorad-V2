<?php
    require 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    function connection(){
        //CONNECT TO MYSQL DATABASE USING MYSQLI
        $link = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

        // Check connection
        if(!$link){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        return $link;
    }
?>