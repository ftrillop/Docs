<html>
    <head>
        <title>Registrar nota</title>
        <style>
            p {
                text-align: center;
            }
            a {
                margin-left: 52.5em;
            }
        </style>
    </head>
    <body>
        <?php
            if (isset($_POST["dni"])) {
                $dni = $_POST["dni"];
                if (isset($_POST["nota"])) {
                    $nota = $_POST["nota"];
                    $fichero = "registro.txt";
                    $archivo = fopen("registro.txt", "a");

                    $registro = "DNI: $dni - Nota: $nota";
                    $lineaBlanca = "-----------------------------------";

                    fputs($archivo, $registro.PHP_EOL);
                    fputs($archivo, $lineaBlanca.PHP_EOL);
                    fclose($archivo);
                }
            }
            
        ?>
        <p>Os datos gardaronse correctamente.</p>
        <a href="registroNotas.php">Volver</a>
    </body>
</html>