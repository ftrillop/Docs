<html>
    <head>
        <title>Formulario 10</title>
    </head>
    <body>
        <table border="1">
        <?php
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
        ?>

        <?php
        
        $limite = 1;
      
        for ($i=0; $i<=50000; $i++) {

            if ($limite == 6) {
                echo "</tr><tr>";
                $limite=1;
            }
            echo "<td bgcolor=Grey>";
            echo "$i";
            echo "</td>";
            $valor = "&#$i";
            echo "<td>";
            echo "$valor";
            echo "</td>";
            $limite++;
        }
        
        ?>
        </table>
    </body>
</html>