<html>
    <head>
        <title>Formulario 9</title>
    </head>
    <body>
        <table border="1">
        <?php
        echo "<tr>";
        for ($i=1; $i<=8; $i++) {
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
      
        for ($i=1; $i<=127; $i++) {

            if ($limite == 9) {
                echo "</tr><tr>";
                $limite=1;
            }
            echo "<td bgcolor=Grey>";
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