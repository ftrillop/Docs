<html>
    <head>
        <title>Cursos</title>
        <style>
            table{
                border-collapse: collapse;
                width:100%;
            }

            td:first-of-type{
                font-weight:bold;
            }
            td:last-of-type{
                text-align: right;
                padding-right:10px;
            }
            th{
                text-align: justify;
                background-color: black;
                color:white;
            }
            td a{
                text-align: left;
            }
            td{
                text-align: justify;
            }
            .par{
                background-color: grey;
            }
        </style>
    </head>
    <body>
        <h1>Lista de cursos</h1>
        <table>
            <tr>
                <th>Cursos disponibles</th>
                <th>Plazas totales</th>
                <th>Plazas disponibles</th>
                <th>Quitar plaza</th>
                <th>Añadir plaza</th>
            </tr>
            <?php
            $conexion = new mysqli("127.0.0.1", "root", "", "cursos");
            if ($conexion) {
                $sql = "SELECT id_curso, curso, plazas_totales, plazas_ocupadas, (plazas_totales-plazas_ocupadas) AS plazas_libres FROM cursos";
                $consulta = mysqli_query($conexion, $sql);
                $plazasTotales = 0;
                $plazasOcupadas = 0;
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    while ($fila) {
                        $curso = $fila["id_curso"];
                        $plazasTotales += $fila["plazas_totales"];
                        $plazasOcupadas += $fila["plazas_ocupadas"];
                        if ($fila["plazas_libres"] == 0) {
                            if ($fila["id_curso"]%2==0) {
                                echo "<tr class='par'>";
                                echo "<td><del>".$fila["curso"]."</del></td>";
                                echo "<td><del>".$fila["plazas_totales"]."</del></td>";
                                echo "<td><del>".$fila["plazas_libres"]."</del></td>";
                                echo "<td></td>";
                                echo "<td><a href='BD6-quitar.php?curso=$curso'>Quitar plaza</a></td>";
                                echo "</tr>";
                            } else {
                                echo "<tr>";
                                echo "<td><del>".$fila["curso"]."</del></td>";
                                echo "<td><del>".$fila["plazas_totales"]."</del></td>";
                                echo "<td><del>".$fila["plazas_libres"]."</del></td>";
                                echo "<td></td>";
                                if ($fila["plazas_libres"] < $fila["plazas_totales"]) {
                                    echo "<td><a href='BD6-quitar.php?curso=$curso'>Quitar plaza</a></td>";
                                } else {
                                    echo "<td></td>";
                                }
                                echo "</tr>";
                            }

                        } else {
                            if ($fila["id_curso"]%2==0) {
                                echo "<tr class='par'>";
                                echo "<td>".$fila["curso"]."</td>";
                                echo "<td>".$fila["plazas_totales"]."</td>";
                                echo "<td>".$fila["plazas_libres"]."</td>";
                                echo "<td><a href='BD6-añadir.php?curso=$curso'>Añadir plaza</a></td>";
                                if ($fila["plazas_libres"] < $fila["plazas_totales"]) {
                                    echo "<td><a href='BD6-quitar.php?curso=$curso'>Quitar plaza</a></td>";
                                } else {
                                    echo "<td></td>";
                                }
                                echo "</tr>";
                            } else {
                                echo "<tr>";
                                echo "<td>".$fila["curso"]."</td>";
                                echo "<td>".$fila["plazas_totales"]."</td>";
                                echo "<td>".$fila["plazas_libres"]."</td>";
                                echo "<td><a href='BD6-añadir.php?curso=$curso'>Añadir plaza</a></td>";
                                if ($fila["plazas_libres"] < $fila["plazas_totales"]) {
                                    echo "<td><a href='BD6-quitar.php?curso=$curso'>Quitar plaza</a></td>";
                                } else {
                                    echo "<td></td>";
                                }
                                echo "</tr>";
                            }

                        }

                        $fila = $consulta->fetch_assoc();
                    }
                    $porcentaje = $plazasOcupadas*100/$plazasTotales;
                    echo "</table>";
                    echo "<h2>Resumen de ocupación:</h2>";
                    echo "<ul>";
                    echo "<li><strong>Plazas totales ofertadas: </strong>$plazasTotales</li>";
                    echo "<li><strong>Plazas ocupadas: </strong>$plazasOcupadas</li>";
                    echo "<li><strong>Porcentaje de ocupación: </strong>$porcentaje%</li>";
                    echo "</ul>";
                }
            }
            ?>
    </body>
</html>