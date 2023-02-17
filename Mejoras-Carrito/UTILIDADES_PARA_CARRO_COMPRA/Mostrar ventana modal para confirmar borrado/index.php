<?php
session_start();
include_once("db.php");
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>CRUD PHP - Registrar</title>
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
<style>
ul{
padding: 0px;
margin: 0px;
}
#mi_lista li{
color: #fff;
background-color: #007bff;
border: #fff 1px solid;
margin: 0 0 3px;
padding: 10px;
list-style: none;
cursor:pointer;
}
</style>
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">DAW2023</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Listar <span class="sr-only">(current)</span></a>
            </li>  
            <li class="nav-item active">
              <a class="nav-link" href="registrar_usuario.php">Registrar</a>
            </li> 
                   
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Busqueda</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->

<div class="container">
 <h1 class="mt-5">Listar Clientes</h1>
 <hr>
<div class="row">
  <div class="col-12 col-md-6">
   <!-- Contenido --> 
   
   
			<?php
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			
			//Recibir el número de página
			$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);		
			$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
			
			//Personalizar cantidad por pagina
			$qnt_result_pg = 2;
			
			//calcular visualizacion de priemra pagina
			$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
			
			$result_usuarios = "SELECT * FROM usuarios LIMIT $inicio, $qnt_result_pg";
			$resultado_usuarios = mysqli_query($conectar, $result_usuarios);
			while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
				echo "ID: " . $row_usuario['id'] . "<br>";
				echo "Nombres: " . $row_usuario['nombres'] . "<br>";
				echo "E-mail: " . $row_usuario['email'] . "<br>";
				echo "<a style='margin:3px' class='btn btn-primary' href='editar_usuario.php?id=" . $row_usuario['id'] . "'>Editar</a>";
				echo "<a style='margin:3px' class='btn btn-primary' href='proceso_borrar_usuario.php?id=" . $row_usuario['id'] . "' data-confirm='¿Está seguro de que desea eliminar el elemento seleccionado?'>Borrar</a><hr>";
			}
			
			//Sumar cantidades para la paginacion
			$result_pg = "SELECT COUNT(id) AS num_result FROM usuarios";
			$resultado_pg = mysqli_query($conectar, $result_pg);
			$row_pg = mysqli_fetch_assoc($resultado_pg);
		
			//Cantidad de pagina 
			$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
			
			//Limitar cantidad de vinculos
			$max_links = 2;
			echo "<ul class='pagination'><li class='page-item'><a class='page-link' href='index.php?pagina=1'>Primero</a></li>";
			
			for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
				if($pag_ant >= 1){
					echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag_ant'>$pag_ant</a></li>";
				}
			}
				
			echo "<li class='page-item'><a class='page-link' href='#'>$pagina</a></li> ";
			
			for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
				if($pag_dep <= $quantidade_pg){
					echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag_dep'>$pag_dep</a></li>";
				}
			}
			
			echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$quantidade_pg'>Ultima</a></li></ul>";
			
		?>	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="js/personalizado.js"></script>		



 <!-- Fin Contenido --> 
</div>
</div><!-- Fin row -->
</div><!-- Fin container -->
    <footer class="footer">
      <div class="container">
        <span class="text-muted"><p>Códigos <a href="https://www.GMAIL.COM.com/" target="_blank">DAW2023_PHP</a></p></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
  </body>
</html>
