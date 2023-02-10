<html>
    <body>
        <?php
         if (isset($_GET["n"])) {
            echo "<h1>Mostrar suma de pares</h1>";
            $n = $_GET["n"];
            $suma = 0;
            if (is_numeric($n) && $n > 1) {
                
                if ($n % 2 == 0){
                for ($i=$n; $i>1; $i--) {
                    if ($i % 2 == 0) {
                        $suma+=$i;
                    }
                }

                echo "<p>La suma es $suma</p>";
            } else {
                $n = $n - 1;

                for ($i=$n; $i>1; $i--) {
                    if ($i % 2 == 0) {
                        $suma+=$i;
                    }
                }
                echo "<p>La suma es $suma</p>";
            }
            } else {
            echo "<p>Necesitas introducir un numero mayor a 1</p>";
            }
        }
        ?>
    </body>
</html>