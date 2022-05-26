<?php
$link = mysqli_connect('localhost','root','','demo2');

if($link === false){
    die("Error :: could not connect ".mysqli_connect_error());
    // header('Location: error.php');
}

$search_key = $_POST['search'];

if(trim($search_key) != ''){
    $sql="SELECT id FROM employees WHERE LOWER(name) LIKE LOWER('$search_key%')";

    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_all($result);
    echo  json_encode($row,1);
}else{
    echo  json_encode([],1);
}