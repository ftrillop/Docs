<html>
    <head>
        <title>Formulario</title>
    </head>
    <body>
        <?php
        $red = mt_rand(0, 255);
        $blue = mt_rand(0, 255);
        $green = mt_rand(0, 255);
        $a = '0.2';

        $fondo = 'rgba('.$red.','.$green.','.$blue.','.$a.')';
        ?>
        <?php
        echo "<style> body{background-color: $fondo} </style>";
        ?>
        
    </body>
</html>