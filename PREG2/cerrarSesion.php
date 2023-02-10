<?php
session_name('MENSAJES');
session_start();
session_destroy();
header('Location:.');