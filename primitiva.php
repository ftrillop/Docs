<html>
    <head>
        <title>Primitiva</title>
    </head>
    <body>
        <?php
        for ($i=1; $i<=100; $i++) {
            $num1 = mt_rand(1, 49);
            $num2 = mt_rand(1, 49);
 
            while ($num2 == $num1) {
                $num2 = mt_rand(1, 49);
            }
            $num3 = mt_rand(1, 49);
            while (($num3 == $num1) || ($num3 == $num2)) {
                $num3 = mt_rand(1, 49);
            }
            $num4 = mt_rand(1, 49);
            while (($num4 == $num1) || ($num4 == $num2) || ($num4 == $num3)) {
                $num4 = mt_rand(1, 49);
            }
            $num5 = mt_rand(1, 49);
            while (($num5 == $num1) || ($num5 == $num2) || ($num5 == $num3) || ($num5 == $num4)) {
                $num5 = mt_rand(1, 49);
            }
            $num6 = mt_rand(1, 49);
            while (($num6 == $num1) || ($num6 == $num2) || ($num6 == $num3) || ($num6 == $num4) || ($num6 == $num5)) {
                $num6 = mt_rand(1, 49);
            }
            echo "Combinacon $i: $num1 $num2 $num3 $num4 $num5 $num6<br>";
        }
        ?>
    </body>
</html>