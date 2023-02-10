<html>
    <head>
        <title>Encriptacion Cesar</title>
    </head>
    <body>
        <?php
        if (isset($_POST["mensaje"])) {
            $mensaje = $_POST["mensaje"];

            if ($mensaje == "") {
                echo "El mensaje no puede estar vacio<br>";
            } elseif (strlen($mensaje) <= 10) {
                echo "El mensaje debe tener mas de 10 caracteres<br>";
            } else {
                if (isset($_POST["clave"])) {
                    $clave = $_POST["clave"];
                    if (($clave >= 1) && ($clave <= 99)) {
                        if (isset($_POST["metodo"])) {
                            $metodo = $_POST["metodo"];
                            if ($metodo == "Encriptar") {
                                $codificacion = "";

                                for ($i=0; $i<strlen($mensaje); $i++) {
                                
                                    $codificacion .= chr(ord($mensaje[$i]) + $clave);
                                
                                }
                                echo "El texto codificado es <blockquote>$codificacion</blockquote><br>";
                                echo "<a href='Encriptar.html'>Volver a cifrar</a>";
                            }

                            if ($metodo == "Desencriptar") {
                                $codificacion = "";

                                for ($i=0; $i<strlen($mensaje); $i++) {
                                
                                    $codificacion .= chr(ord($mensaje[$i]) - $clave);
                                
                                }
                                echo "El texto descodificado es <blockquote>$codificacion</blockquote><br>";
                                echo "<a href='Encriptar.html'>Volver a cifrar</a>";
                            }
                        }
                } else {
                    echo "La clave debe ser un numero entre el 1 y el 99<br>";
                }    
            }
        }
    }
        ?>
    </body>
</html>