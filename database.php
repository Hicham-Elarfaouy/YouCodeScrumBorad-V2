<?php

    function connection(){
        //CONNECT TO MYSQL DATABASE USING MYSQLI
        $link = mysqli_connect("localhost", "root", "", "youcodescumboard");

        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        return $link;
    }
?>