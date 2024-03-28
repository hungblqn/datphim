<?php  
    session_start();

        if(isset($_SESSION['name'])){
            unset($_SESSION['name']);
            unset($_SESSION['id']);
            unset( $_SESSION['password']);
            unset( $_SESSION['username']);

               header("location: ../controller/index.php?act=login");
        }

      
?>