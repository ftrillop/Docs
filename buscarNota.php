<html>
    <head>
        <title>Buscar por DNI
        </title>
        <style>
            h1 {
                text-align: center;
            }
            a {
                margin-left: 49.5em;
            }
            form {
                margin-left: 45em;
            }
            .Rexistrar {
                margin-left: 6em;
            }
        </style>
    </head>
    <body>
        <h1>Busca unha nota asociada a un DNI</h1>
        <form action="EncontrarNota.php" method="post">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" class="dni">
            <br>
            <input type="submit" value="Rexistrar" id="Rexistrar" class="Rexistrar">
        </form>
        <br>
        <a href="registroNotas.php">Rexistrar nota</a>
    </body>
</html>