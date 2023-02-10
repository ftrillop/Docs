<html>
    <head>
        <title>Ejercicio 5</title>
    </head>
    <body>

        <?php

        

        for ($i=1; $i<=10; $i++) {

            for ($j=1; $j<=10; $j++) {

                $producto = $i * $j;
                echo "<p>$i * $j = $producto</p>";
            }
            
            echo "**********<br>";
        }

        ?>

    </body>
</html>