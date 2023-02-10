<?php
    use PHPMailer\PHPMailer\PHPMailer;
    if (!isset($_SESSION["hayPedido"])) {
        header("location: pedidos.php");
    }
    
    else {
        $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
        if ($conexion) {
            $sql = "SELECT r.Correo, p.CodPed, pr.Nombre, pd.CodPredProd, pd.Unidades FROM restaurantes AS r JOIN pedidos AS p ON (r.CodRes=p.Restaurante) JOIN pedidosproductos AS pd ON (p.CodPed=pd.CodPed) JOIN productos AS pr ON (pd.CodProd=pr.CodProd)";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                while ($fila) {
                    $msg = "".$fila["CodPed"]."".$fila["Correo"]."".$fila["Nombre"]."".$fila["Unidades"];
                    echo "".$fila["CodPed"]."".$fila["Correo"]."".$fila["Nombre"]."".$fila["Unidades"];
                    $fila = $consulta->fetch_assoc();
                }
            }
        }

        date_default_timezone_set('Etc/UTC');

        require '../vendor/autoload.php';

        $mail = new PHPMailer; //instanciamos PHPMailer.

        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->Port = 25;

       //dirección de quen envía
        $mail->setFrom('asdfgpt@gmail.com', 'Fernando');
    
        $mail->addAddress('fertrillop@gmail.com', 'Prueba de envío');

        if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
            $mail->Subject = 'PHPMailer contact form';
            //Keep it simple - don't use HTML
            $mail->isHTML(false);
            //Build a simple message body
            $mail->Body = <<<EOT
            Lista de pedidos
            EOT;
        }
}
?>