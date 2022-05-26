<?php

session_start();
function auth(){
    if(isset($_SESSION['name']) && (count($_SESSION['name']) > 0)){
        return true;
    }else{
        return false;
    }
}

// unset($_SESSION['user']);

?>