<?php
use PHPMailer;
session_start();
$usuario = 0;
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
} else {
    $usuario = $_SESSION["CodRes"];
}
require '../vendor/autoload.php';

?>
<html>
    <head>
        <title>Pedido realizado</title>
        <style>
            h1 {
                text-align: center;
            }
            a {
                text-align: center;
            }
            p {
                background-color: royalblue;
                color: white;
                font-size: 30px;
                padding-top: 1%;
                padding-bottom: 1%;
            }
            p a {
                color: white;
                text-decoration: none;
                margin-top: 0%;
                margin-left: 1%;
                padding: 1% 1% 1% 1%;
            }
            p a:hover {
                 background-color: #4141e1;
            }
        </style>
    </head>
    <body>
        <?php
        $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
        $CodPed = "";
        $productos = [];
        if ($conexion) {
            $sql = "SELECT CodProd, Stock FROM productos";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                while ($fila) {
                    if (isset($_SESSION["art".$fila["CodProd"]])) {
                        if ($_SESSION["art".$fila["CodProd"]] > 0) {
                            $productos[$fila["CodProd"]] = $_SESSION["art".$fila["CodProd"]];
                        }
                    }
                    $fila = $consulta->fetch_assoc();
                }
            }
            if (sizeof($productos)>0) {
                $conexion->begin_transaction();
                $sql = "INSERT INTO pedidos (Fecha, Enviado, Restaurante) VALUES (NOW(), 0, $usuario)";
                $consulta = mysqli_query($conexion, $sql);
                if (!$consulta) {
                    $conexion->rollback();
                }
                $CodPed = mysqli_insert_id($conexion);
                $contador = 0;
                foreach ($productos as $indice=>$valor) {
                    $sql = "SELECT * FROM productos WHERE CodProd='$indice' AND Stock>='$valor'";
                    $consulta = mysqli_query($conexion, $sql);
                    $fila = $consulta->fetch_assoc();
                    if (mysqli_num_rows($consulta)>0) {
                        $sql = "INSERT INTO pedidosproductos (CodPed, CodProd, Unidades) VALUES ($CodPed,$indice,$valor)";
                        $consulta = mysqli_query($conexion, $sql);
                        if (!$consulta) {
                            $conexion->rollback();
                        } else {
                            $sql = "UPDATE productos SET Stock=Stock-$valor WHERE CodProd='$indice'";
                            $consulta = mysqli_query($conexion, $sql);
                            if (!$consulta) {
                                $conexion->rollback();
                            } else {
                                $contador++;
                            }
                        }
                    } else {
                        $conexion->rollback();
                    }
                }
                if ($contador==sizeof($productos)) {
                    
                    $sql = "SELECT Direccion, Correo FROM Restaurantes WHERE CodRes='".$_SESSION["CodRes"]."'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = $consulta->fetch_assoc();
                        $destinatario = $fila["Direccion"];
                        $nombre = $fila["Correo"];
                        $mensaje = "Se ha realizado un pedido de los siguiente artículos:";
                        foreach ($productos as $indice=>$valor){
                            $mensaje .= "\n■ $valor";
                        }

                        date_default_timezone_set('Etc/UTC');
                        require '../vendor/autoload.php';
                        
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->Host = 'localhost';
                        $mail->Port = 25;

                        $mail->setFrom('asdfgpt@gmail.com', 'Servicio de mensajería');
                        $mail->addAddress("fertrillop@gmail.com", $nombre);

                        if ($mail->addReplyTo($destinatario, $nombre)) {
                            $mail->isHTML(false);

                            $mail->Body = <<<EOT
                            Email: {$destinatario}
                            Name: {$nombre}
                            Message: {$mensaje}
                            EOT;
                            if ($mail->send()) {
                                echo "Se ha enviado el mensaje correctamente";
                            } else {
                                echo "No se pudo enviar el mensaje";
                            }
                        }
                    }

                    echo "<h1>El pedido se ha realizado correctamente</h1>";
                    echo "<a href='vaciar-carro.php'>Volver al carro de compra</a>";
                } else {
                    echo "<h1>El pedido NO se ha realizado</h1>";
                    echo "<a href='vaciar-carro.php'>Volver al carro de compra</a>";
                }
                $conexion->commit();
            } else {
                echo "<h1>El pedido no se ha realizado</h1>";
                echo "<a href='vaciar-carro.php'>Volver al carro de compra</a>";
            }
        }
        ?>
    </body>
</html>