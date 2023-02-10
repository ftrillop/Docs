<html>
    <head>
        <title></title>
    </head>
    <body>

    <?php
    session_start();
    include "comprobarDatos2.php";
    if (haySession()==true) {
        header("location: practica2_saludo.php");
    }
    ?>
        
        <form action="practica2_saludo.php">

            <p><label for="nombre">Nombre </label><input type="text" name="nombre"></p>
            <p><label for="apellidos">Apellidos </label><input type="text" name="apellidos"></p>
            <p><label for="color_fondo">Color de fondo </label><input type="color" name="color_fondo"></p>
            <p><label for="color_letra">Color de letra </label><input type="color" name="color_letra"></p>
            <p><label for="tipo_letra">Tipo de letra </label>
            <select name="tipo_letra">
                <option value="'Shadows Into Light', cursive">Shadows Into Light</option>
                <option value="'Slabo 27px', serif">Slabo 27px</option>
                <option value="'Roboto', sans-serif">Roboto</option>
            </select>
            </p>
            <p><input type="submit" value="Enviar"></p>
        </form>
    </body>
</html>