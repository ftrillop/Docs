<html>
    <body>
        <?php
        $contador = 1;
        echo "<table border=1>";
        for ($i=1; $i<=20; $i++) {
            echo "<tr>";
            for ($j=1; $j<=5; $j++) {
                echo "<td>";
                echo "$contador";
                $contador++;
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </body>
</html>