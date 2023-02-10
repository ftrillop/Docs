<?php
function hayGet() {
    return isset($_GET["usuario"])&&isset($_GET["password"]);
}
function haySession() {
    return isset($_SESSION["usuario"])&&isset($_SESSION["password"]);
}
function iniciar() {
    if (isset($_SESSION["usuario"])&&isset($_SESSION["password"])) {
        if (($_SESSION["usuario"] == "admin")&&($_SESSION["password"] == '123456')) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>