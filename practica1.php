<html>
    <head>



        <title>Practica 1</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <style>
            input.numero {
                border: 1px solid;
                border-radius: 3px;
            }
            * {
                padding-left: 10;
            }
            table {
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <h1>T&aacute;boa do 
            <?php
            if (isset($_POST["numero"])) {
                $numero = $_POST["numero"];
                echo "$numero";
            }
            ?>
         </h1><br>
        <form action="practica1.php" method="post">
            <label for="numero">N&uacute;mero </label>
            <input type="number" class="numero" id="numero" name="numero" value="<?php echo "$numero"; ?>">
            <input type="submit" value="Xerar T&aacute;boa">
        </form>

        <table border="1">
            <?php

            $producto = 0;

            echo "<tr>";
            echo "<th>Numero</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th>Resultado</th>";
            echo "</tr>";
            for ($i=1; $i<=10; $i++) {
                $producto = $numero*$i;
                echo "<tr>";
                echo "<td>$numero</td>";
                echo "<td>X</td>";
                echo "<td>$i</td>";
                echo "<td>=</td>";
                echo "<td>$producto</td>";
                echo "</tr>";                
            }
            ?>
        </table>
    </body>
</html>