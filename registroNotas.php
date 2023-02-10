<html>
    <head>
        <title>Registro de notas</title>
        <style>
            h1, h5 {
                text-align: center;
            }
            a {
                margin-left: 47em;
            }
            form {
                margin-left: 45em;
            }
            label.nota {
                margin-left: 5em;
            }
            .Rexistrar {
                margin-left: 6em;
            }
        </style>
    </head>
    <body>
        <h1>Registro de Notas</h1>
        <h5>Antes de abrir o rexistro de notas hai que introducir algun dato mediante o formulario</h5>

        <form action="registrarNota.php" method="post">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" class="dni">
            <br>
            <label for="nota" class="nota">Nota:</label>
            <select name="nota" id="nota" class="nota">

                <?php
                for ($i=0; $i<=10; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Rexistrar" id="Rexistrar" class="Rexistrar">
        </form>
        <br>
        <a href="abrirRegistro.php">Abrir Rexistro de Datos</a><br>
        <a href="buscarNota.php">Buscar Nota por DNI</a>
    </body>
</html>