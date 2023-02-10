<html>
    <head>
        <title>ASCII</title>
        <style>
            * {
                text-align: center;
                border-collapse: collapse;
            }
            table {
                position: relative;
                left: 37.5%;
            }
            a {
                background-color: grey;
                color: white;
                width: 20px;
                border: 1px solid blue;
                padding-left: 1em;
                padding-right: 1em;
            }
            p {
                background-color: black;
                color: white;
                font-size: 40px;
            }
            .antes {
                position: relative;
                right: 40%;
            }
            .despues {
                position: relative;
                left: 40%;
            }
            .antes:hover {
                background-color: red;
            }
            .despues:hover {
                background-color: red;
            }
            
        </style>
    </head>
    <body>
    <table border="1">
        <?php
        $contador = 1;
        $num_paginas = intdiv(10000, 500);

        if (isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
            if ($pagina<=0||is_numeric($pagina)==false) {
                $pagina = 1;
            }
        } else {
            $pagina = 1;
        }

        $direccion = "Ejercicio1.php?pagina=";

        echo "<p>";

        if ($pagina > 1) {
            echo "<a class='antes' href='$direccion".($pagina-1)."'>&lt; </a>";
        }
        for ($i=1; $i<=$num_paginas; $i++) {
            if ($pagina == $i) {
                echo "Pagina $i";
            } 
        }
        if ($pagina < $num_paginas) {
            echo "<span class='pagina'>";
            echo "<a class='despues' href='$direccion".($pagina+1)."'>&gt; </a>";
            echo "</span>";
        }
        echo "</p>";

        echo "<br>";
        echo "<tr>";
        for ($i=1; $i<=5; $i++) {
            echo "<td bgcolor=Black>";
            echo "<font color='white'>Codigo</font>";
            echo "</td>";
            echo "<td bgcolor=Black>";
            echo "<font color='white'>Valor</font>";
            echo "</td>";
        }
        echo "</tr>";
 
        $limite = 1;
        $posMin = (($pagina-1)*500)+1;
        $posMax = $pagina*500;
      
        for ($i=$posMin; $i<=$posMax; $i++) {

            if ($limite == 6) {
                echo "</tr><tr>";
                $limite=1;
            }
            echo "<td bgcolor=violet>";
            echo "$i";
            echo "</td>";
            $valor = chr($i);
            echo "<td>";
            echo "$valor";
            echo "</td>";
            $limite++;
        }
        
        ?>
        </table>
    </body>
</html>