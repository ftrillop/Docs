<html>
    <head>
        <title>Liga de futbol</title>
    </head>
    <body>
        <?php
        $equipos = array (
            "F.C. Barcelona" => 94,
            "Real Madrid" => 92,
            "Atletico Madrid" => 78,
            "Valencia" => 77,
            "Sevilla" => 76,
            "Villareal" => 60,
            "Malaga" => 50,
            "Espanyol" => 49,
            "Athlétic Bilbao"=>55,
            "Celta"=>51,
            "Real Sociedad"=>46,
            "Rayo Vallecano"=>49,
            "Getafe"=>37,
            "Eibar"=>35,
            "Elche"=>41,
            "Deportivo"=>35,
            "Almería"=>29,
            "Levante"=>37,
            "Granada"=>35,
            "Córdoba"=>20
        );
        arsort($equipos);
        $clasificacion = array_keys($equipos);
        ?>
        <form action='Ejercicio2.php' method="post">
        <label for='equipo'>Elija el equipo </label>
        <select name='equipo' id='equipo'>
        <?php
        ksort($equipos);
        foreach ($equipos as $nombre => $puntos) {
            echo "<option value='$nombre'>$nombre</option>";
        }
        ?>
        </select>
        <br>
        <button>Comprobar</button>
        </form>
        <?php
        if (isset($_POST["equipo"])) {
            $equipo = $_POST["equipo"];
            if(isset($equipos[$equipo])) {
                $puntos = $equipos[$equipo];
                $posicion = array_search($equipo, $clasificacion)+1;
                echo "<br>El equipo $equipo tiene $puntos puntos, "."ahora mismo es el $posicion"."º en la clasificacion";
            }
        }
        ?>  
    </body>
</html>