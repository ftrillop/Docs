<?php
    session_start();
    unset($_SESSION);
    session_destroy();
    header("location: identificar.php");
?>