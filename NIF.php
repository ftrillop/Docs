<html>
    <head>
        <title>Validar NIF</title>
    </head>
    <body>
        <?php
 
        $nombreMal = false;
        $apellido1Mal = false;
        $apellido2Mal = false;
        $usuarioMal = false;
        $dniMal = false;
        $telefonoMal = false;
 
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            if ($nombre == "") {
                echo "El campo nombre no puede estar vacio<br>";
                $nombreMal = true;
            } else {
                if (preg_match("/^[a-zA-Z]+$/", $nombre)) {
                    echo "El nombre es valido<br>";
                } else {
                    echo "El nombre contiene caracteres no validos<br>";
                    $nombreMal = true;
                }
            }
        }
 
        if (isset($_POST["apellido1"])) {
            $apellido1 = $_POST["apellido1"];
            if ($apellido1 == "") {
                echo "El campo apellido1 no puede estar vacio<br>";
                $apellido1Mal = true;
            } else {
                if (preg_match(("/^[a-zA-Z]+$/"), $apellido1)) {
                    echo "El apellido1 es valido<br>";
                } else {
                    echo "El apellido1 contiene caracteres no validos<br>";
                    $apellido1Mal = true;
                }
            }
        }
 
        if (isset($_POST["apellido2"])) {
            $apellido1 = $_POST["apellido2"];
            if ($apellido1 == "") {
                echo "El campo apellido2 no puede estar vacio<br>";
                $apellido2Mal = true;
            } else {
                if (preg_match(("/^[a-zA-Z]+$/"), $apellido1)) {
                    echo "El apellido2 es valido<br>";
                } else {
                    echo "El apellido2 contiene caracteres no validos<br>";
                    $apellido2Mal = true;
                }
            }
        }
 
        if (isset($_POST["usuario"])) {
            $usuario = $_POST["usuario"];
            if ($usuario == "") {
                echo "El campo usuario no puede estar vacio<br>";
                $usuarioMal = true;
            } else {
                if (preg_match("/^[a-zA-Z][a-zA-Z0-9]{5,}+$/", $usuario)) {
                    echo "El usuario es valido<br>";
                } else {
                    echo "El usuario contiene caracteres no validos<br>";
                    $usuarioMal = true;
                }
            }
        }
 
        if (isset($_POST["dni"])) {
            $dni = $_POST["dni"];
            $numero = intval(preg_replace("/[^0-9]+/", "", $dni));
            if ($dni != ""){
                $letra = $dni[-1];
            }
            $resto = $numero%23;
            $caracterCorrecto = array (
                0 => 'T', 1 => 'R', 2 => 'W', 3 => 'A',
                4 => 'G', 5 => 'M', 6 => 'Y', 7 => 'F',
                8 => 'P', 9 => 'D', 10 => 'X', 11 => 'B',
                12 => 'N', 13 => 'J', 14 => 'Z', 15 => 'S',
                16 => 'Q', 17 => 'V', 18 => 'H', 19 => 'L',
                20 => 'C', 21 => 'K', 22 => 'E'
            );
            if ($dni == "") {
                echo "El campo dni no puede estar vacio<br>";
                $dniMal = true;
            } else {
                if (preg_match("/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]/", $dni)) {
                    if ($letra == $caracterCorrecto[$resto]) {
                        echo "El dni es valido<br>";
                    } else {
                    echo "El dni no es valido<br>";
                    $dniMal = true;
                }
            }
            elseif (preg_match("/^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]/", $dni)) {
                $numero = substr($dni, 0, -1);
                $letra = $dni[-1];
 
                if (preg_match("/^[X][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]/", $dni)) {
                   $numero = str_replace('X', 0, $numero);
                   $resto = $numero%23;
                   if ($letra == $caracterCorrecto[$resto]) {
                    echo "El NIE es valido<br>";
                   } else {
                    echo "El NIE no es valido<br>";
                    $dniMal = true;
                   }
                }
                if (preg_match("/^[Y][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]/", $dni)) {
                    $numero[0] = 1;
                    $resto = $numero%23;
                    if ($letra == $caracterCorrecto[$resto]) {
                        echo "El NIE es valido<br>";
                       } else {
                        echo "El NIE no es valido<br>";
                        $dniMal = true;
                       }
                }
                if (preg_match("/^[Z][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]/", $dni)) {
                    $numero[0] = 2;
                    $resto = $numero%23;
                    if ($letra == $caracterCorrecto[$resto]) {
                        echo "El NIE es valido<br>";
                       } else {
                        echo "El NIE no es valido<br>";
                        $dniMal = true;
                       }
                }
            } else {
                echo "El NIE no es valido<br>";
                $dniMal = true;
            }
        }
    }
 
    if (($nombreMal == true)||($apellido1Mal == true)||($apellido2Mal == true)||($usuarioMal == true)||($dniMal == true)) {
        echo "<br><a href='NIF.html'>Volver al formulario</a>";
    }
        ?>
    </body>
</html>