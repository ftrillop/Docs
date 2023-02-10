<html>
    <head>
        <title>Listado de localidades</title>
        <style>
            .error{
            color:red;
            }
            .pagina{
                background-color: lightgray;
                font-size:.7em;
            }
            table{
                border-collapse: collapse;
                width:100%;
            }
            td{
                border:1px solid black;
            }
            td:first-of-type{
                font-weight:bold;
            }
            td:last-of-type{
                text-align: right;
                padding-right:10px;
            }
            th{
                background-color: black;
                color:white;
            }
            .paginaActual{
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <?php
            if (isset($_GET["provincia"])) {
            
                $provincia = $_GET["provincia"];
                $primeraLetra = strtoupper($provincia[0]);
                $restoLetras = strtolower($provincia);
                $provincia = $restoLetras;
                $provincia[0] = $primeraLetra;
            
                $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
                if ($conexion) {
                   // $consulta = $conexion->query("SELECT l.nombre, l.poblacion FROM localidades AS l JOIN provincias AS p ON (l.n_provincia = p.n_provincia) WHERE p.nombre='$provincia'");
                    $sql = "SELECT l.nombre, l.poblacion FROM localidades AS l JOIN provincias AS p ON (l.n_provincia = p.n_provincia) WHERE p.nombre='$provincia'";
                    
                    if ($numLocalidades = mysqli_query($conexion, $sql)) {
                        $contador = mysqli_num_rows($numLocalidades);
                    }
                    
                    $numPaginas = intdiv($contador,25);
                    if ($numPaginas%25 != 0) {
                        $numPaginas+=1;
                    }



                    if ($numLocalidades) {
                        echo "<h1>Localidades de $provincia</h1>";
                        echo "<h2>Hay $contador localidades en $provincia</h2>";
                        echo "<h2>Necesitamos $numPaginas paginas para ver todas las localidades</h2>";

                        if (isset($_GET["pagina"])) {
                            $pagina = $_GET["pagina"];
                            if ($pagina<=0||is_numeric($pagina)==false) {
                                $pagina = 1;
                            }
                        } else {
                            $pagina = 1;
                        }

                        $direccion = "practica2-resultado.php?provincia=$provincia&pagina=";

                        echo "<p>";

                        if ($pagina > 1) {
                            echo "<span class='pagina'>";
                            echo "<a href='$direccion".($pagina-1)."'>&lt; </a>";
                            echo "</span>";
                        }
                        for ($i=1; $i<=$numPaginas; $i++) {

                            
                            if ($i == $pagina) {
                                echo "<span class='paginaActual'>";
                                echo "<a href='$direccion".$i."'>$i </a>";
                                echo "</span>";
                            } else {
                                echo "<span class='pagina'>";
                                echo "<a href='$direccion".$i."'>$i </a>";
                                echo "</span>";
                            }
                            
                        }
                        if ($pagina < $numPaginas) {
                            echo "<span class='pagina'>";
                            echo "<a href='$direccion".($pagina+1)."'>&gt; </a>";
                            echo "</span>";
                        }
                        echo "</p>";

                        $posicion = (($pagina-1)*25);
                        $numLocalidades->data_seek($posicion);
                        $contadorLocalidades = 1;
                        $fila = $numLocalidades->fetch_assoc();
                        echo "<table border=1>";
                        echo "<tr>";
                        echo "<th>Localidad</th>";
                        echo "<th>Poblacion</th>";
                        echo "</tr>";

                        while ($fila && $contadorLocalidades<=25) {
                            echo "<tr>";
                            echo "<td>"."{$fila["nombre"]}</td>";
                            echo "<td>"."{$fila["poblacion"]}</td>";
                            echo "</tr>";
                            $fila = $numLocalidades->fetch_assoc();
                            $contadorLocalidades++;
                        }
                        $fila = $numLocalidades->fetch_assoc();
                        echo "</table>";
                        
                    }
                }
            }
        ?>
    </body>
</html>