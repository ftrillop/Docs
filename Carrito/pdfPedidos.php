<?php
    session_start();
    use Dompdf\Dompdf;
    require_once("dompdf/autoload.inc.php");
    if ($_SESSION["hayPedido"]!="true") {
        header("location: pedidos.php");
    }
    
    else {
        $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
        $mensaje = "<p>";
        if ($conexion) {
            $sql = "SELECT r.Correo, p.CodPed, pr.Nombre, pd.CodPredProd, pd.Unidades FROM restaurantes AS r JOIN pedidos AS p ON (r.CodRes=p.Restaurante) JOIN pedidosproductos AS pd ON (p.CodPed=pd.CodPed) JOIN productos AS pr ON (pd.CodProd=pr.CodProd)";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                while ($fila) {
                    $mensaje .= "(".$fila["CodPed"].")".$fila["Nombre"]." ➭ ".$fila["Unidades"]."</p>";
                    echo "".$fila["CodPed"]."".$fila["Correo"]."".$fila["Nombre"]."".$fila["Unidades"];
                    $fila = $consulta->fetch_assoc();
                }
            }
            $sql = "SELECT Direccion FROM restaurantes WHERE CodRes=".$_SESSION["CodRes"];
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                $direccion = $fila;
            }
        }
        $generarPDF = new DOMPDF();
        $generarPDF->load_html("<div id='mensaje'>".$mensaje."</div>");
        $generarPDF->render();
        $generarPDF->stream(
            "Lista de artículos",
            array(
                "Attachment" => true
            )
        );
    }
?>