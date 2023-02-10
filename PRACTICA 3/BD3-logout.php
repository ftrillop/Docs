<?php
    session_start();
    unset($_SESSION);
    session_destroy();
    header("location:BD3-index.php");
?>