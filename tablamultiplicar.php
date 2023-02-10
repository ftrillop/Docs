<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <style>
            body {
                margin-left: 2em;
                margin-right: 3em;
            }
            table th, td {
                padding: 0.5em;
            }
            table th {
                padding-right: 10em;
            }
            table td {
                padding-right: 4em;
            }
        </style>
        <title>T&aacute;boa do <?php 
        if (isset($_POST["numero"])) {
            $numero = $_POST["numero"];
                echo "".$numero;
        }
        ?></title>
    </head>
    <head>
        <title>Tabla de multiplicar</title>
        
    </head>
    <body>
        <h1>T&aacute;boa de multiplicar</h1>
        <br>
        <form action="tablamultiplicar.php" method="post" class='form-inline'>
                <label for="numero">
                    <strong>Numero</strong>
                </label>
                <input class='form-control' type="number" id="numero" name="numero" value="<?php echo "".$numero; ?>">
                <input class="btn btn-default" type="submit" value="Xerar T&aacute;boa">
        </form>
        <table class='table table-striped table-bordered table-hover'>
            <?php
            $producto = 0;
            echo"<tr>";
            echo"<th>Numero</th>";
            echo"<td></td>";
            echo"<td></td>";
            echo"<td></td>";
            echo"<th>Resultado</th>";
            echo"</tr>";
            for ($i=1; $i<=10; $i++) {
                $producto = $numero*$i;
                if ($i%2 == 0) {

                    echo "<tr class='par'>";
                    echo "<td>$numero</td>";
                    echo "<td>X</td>";
                    echo "<td>$i</td>";
                    echo "<td>=</td>";
                    echo "<td>$producto</td>";
                    echo "</tr>";

                } else {

                    echo "<tr>";
                    echo "<td>$numero</td>";
                    echo "<td>X</td>";
                    echo "<td>$i</td>";
                    echo "<td>=</td>";
                    echo "<td>$producto</td>";
                    echo "</tr>";
                    
                }
            }
            ?>
        </table>
    </body>
</html>