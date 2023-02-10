<html>
    <head>
        <title>Registro de notas</title>
        <style>
            div.notas {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php
        $fichero = "registro.txt";
        $archivo = fopen("registro.txt", "r");
        if (filesize($fichero) >= 0) {
            $array;
            $i=0;
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                $array[$i]=$linea;
                $i=$i+1;
            }
            for ($i=0; $i<count($array); $i++) {
                echo "<div class='notas'>";
                echo $array[$i];
                echo "</div>";
            }
        }
        ?>
        
    </body>
</html>