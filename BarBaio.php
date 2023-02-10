<html>
    <head>
        <title>Bar Baio</title>
        <style>
            h1 {
                text-align: center;
                background-color: #D3D3D3;
                margin: 1em 12.5em 0em 12.5em;
                padding: 1em 0em 1em 0em;
            }
            h2 {
                text-align: center;
                border-top: 1px solid gray;
                border-bottom: 1px solid gray;
                padding-top: 1em;
                padding-bottom: 1em;
            }
            h5 {
                text-align: center;
            }
            label {
                margin-left: 25em;
            }
            label.mensaxe {
                padding-bottom: 4.5em;
                padding-top:  4.5em;
                margin-top: 0.5em;
            }
           
            input.mail{
                margin-left: 3.25em;
                padding-right: 10em;
            }
            input.nome {
                margin-left: 2em;
                padding-right: 10em;
                margin-top: 0.5em;
            }
            textarea.mensaxe {
                margin-left: 1.5em;
                margin-top: 0.5em;
            }
            div {
                display: flex;
            }
            div.botones {
                margin-left: 56.75em;
                margin-top: 0.5em;
            }
            div.comentarios {
                text-align: center;
                border: 1px solid black;
                margin-left: 27.5em;
                margin-right: 27.5em;
                margin-bottom: 1em;
                padding: 1em;
            }
        </style>
    </head>
    <body>
        <h1>Bar Baio</h1>
        <form action="BarBaio.php" method="post">
            <label for="nome">Nome*: </label>
            <input type="text" class="nome" id="nome" name="nome">
            <div class="botones">
                <input type="submit" value="Enviar">
                <input type="reset" value="Borrar">
            </div>
            <br>
            <label for="mail">Mail: </label>
            <input type="text" class="mail" id="mail" name="mail">
            <br>
            <div class="mensaxe">
                <label for="mensaxe" class="mensaxe">Mensaxe: </label>
                <textarea id="mensaxe" class="mensaxe" cols="70" rows="10" name="mensaxe"></textarea>
            </div>
        </form>
 
        <h2>Mensaxes deixados polos usuarios</h2>

        <?php
    
    if (isset($_POST["nome"])) {
        $nome = $_POST["nome"];
        if (empty($nome)) {
            $nome = "sen nome";
        }
        if (isset($_POST["mail"])) {
            $mail = $_POST["mail"];
            if (empty($mail)) {
                $mail = "sen usuario";
            }
            if (isset($_POST["mensaxe"])) {
                $mensaxe = $_POST["mensaxe"];
                if (empty($mensaxe)) {
                    $mensaxe = "sen comentario";
                }
                $data = date ("d/m/Y H:i:s");

                $n = "<b>$nome</b> ";
                $e = "(<a href=\"mailto:$mail\">$mail</a>) ";
                $f = "<b>Fecha: </b>$data<br>";
                $m = "<b>Mensaje: </b>$mensaxe";
                $comentario = $n.$e.$f.$m;
                $archivo = fopen("mensajes.txt", "a");
                fputs($archivo, $comentario.PHP_EOL);
                fclose($archivo);
            }
        }
    }

    ?>
        <?php

       $fichero = "mensajes.txt";
       if (file_exists($fichero)) {
        $archivo = fopen("mensajes.txt", "r");
        if (filesize($fichero) == 0) {
            echo "<h5><em>Todavia no se han agregado comentarios<em></h5>";
        }
         else if (filesize($fichero) > 0) {
            $array;
            $i = 0;
            while (!feof($archivo)) {
                $linea=fgets($archivo);
			    $array[$i]=$linea;
			    $i=$i+1;
            }
            for ($j=0; $j<count($array); $j++){
                echo "<div class='comentarios'>";
                echo $array[$j];
                echo "</div>";
            }
        }
       } else {
        $archivo = fopen("mensajes.txt","a");
       }

        ?>
 
    </body>
</html>