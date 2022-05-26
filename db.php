<?php

    $conn = mysqli_connect('localhost','root','','my_db');

    if($conn === false){
        die("Error :: could not connect ".mysqli_connect_error());
    }

    
?>