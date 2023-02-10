<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
        if (!isset($_REQUEST["numero"])) {
            if (!isset($_REQUEST["aleatorio"])) {
                $intento = 0;
                $aleatorio = mt_rand(1, 100);
            } else {
                $aleatorio = $_REQUEST["aleatorio"];
                $intento = $_REQUEST["intento"];
            }

            echo "<form action='numeroSecreto.php' method='get'>
            Atina o meu numero:
            <input type='number' name='numero'><br>
            <input type='hidden' name='aleatorio' value='$aleatorio'>
            <input type='hidden' name='intento' value='$intento'>
            <br>
            <input type='submit'>
            </form>";
        } else {
            
            $numero = $_REQUEST["numero"];
            $aleatorio = $_REQUEST["aleatorio"];
            $intento = $_REQUEST["intento"];
            $intento++;

            echo "o teu numero e: $numero<br>";

            if ($numero > $aleatorio) {
                echo "o meu numero é menor<br>";
            }
            if ($numero < $aleatorio) {
                echo "o meu numero é maior<br>";
            }
            if ($numero == $aleatorio) {
                echo "Parabéns, atinaches<br>";
                echo "Precisaches $intento intentos<br>";
            }

            echo "<a href='numeroSecreto.php?aleatorio=$aleatorio&intento=$intento'>Sigue xogando...</a>";
        }
        ?>
    </body>
</html>