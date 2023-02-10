<html>
    <body>
        <form action="Formulario5.php">
            <p>Escriba el numero de asteriscos <input type="number" name="n"></p>
            <p><input type="submit" value="Enviar"></p>
        </form>
        <?php
        if (isset($_GET["n"])) {
            
            $n = $_GET["n"];
            
            if (is_numeric($n) && $n >= 1) {
                
                echo "<p>";
                $limite = 1;
                
                for ($i=1; $i<=$n; $i++) {
                    
                    if ($limite == 216) {

                        echo "<br>";
                        $limite = 1;
                    } 
                    
                    echo "*";

                    $limite++;
                
                }
            }
        }
        ?>
    </body>
</html>