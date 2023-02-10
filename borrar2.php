<?php
    session_start();
    unset($_SESSION);
    session_destroy();
    header("location:practica2_index.php");
?>