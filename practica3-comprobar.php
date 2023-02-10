<?php
function haySession() {
    return isset($_SESSION["usuario"])&&isset($_SESSION["password"]);
}
function hayPost() {
    return isset($_POST["usuario"])&&isset($_POST["password"]);
}
?>