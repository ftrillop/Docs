<?php
session_start();
unset($_SESSION);
session_destroy();
header("location:BD4-index.php");
?>
