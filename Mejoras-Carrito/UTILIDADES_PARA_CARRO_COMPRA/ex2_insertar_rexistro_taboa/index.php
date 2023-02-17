<?php include('BDconect.php');?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Actualizar varias filas con CheckBox en PHP usando Ajax | DAW</title>

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/sticky-footer-navbar.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content").fadeOut(1500);
    },3000);

});
</script>
</head>

<body>
<header> 
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <a class="navbar-brand" href="#">DAW</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"> <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a> </li>
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
<?php
    
if(isset($_POST['insertar'])){
///////////// Informacion enviada por el formulario /////////////
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$profesion=$_POST['profesion'];
$estado=$_POST['estado'];
$fregis = date('Y-m-d');
///////// Fin informacion enviada por el formulario /// 

////////////// Insertar a la tabla la informacion generada /////////
$sql="insert into tbl_personal(nombres,apellidos,profesion,estado,fregis) values(:nombres,:apellidos,:profesion,:estado,:fregis)";
    
$sql = $connect->prepare($sql);
    
$sql->bindParam(':nombres',$nombres,PDO::PARAM_STR, 25);
$sql->bindParam(':apellidos',$apellidos,PDO::PARAM_STR, 25);
$sql->bindParam(':profesion',$profesion,PDO::PARAM_STR,25);
$sql->bindParam(':estado',$estado,PDO::PARAM_STR,25);
$sql->bindParam(':fregis',$fregis,PDO::PARAM_STR);
    
$sql->execute();

$lastInsertId = $connect->lastInsertId();
if($lastInsertId>0){

echo "<div class='content alert alert-primary' > Gracias .. Tu Nombre es : $nombres  </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pueden agregar datos, comuníquese con el administrador  </div>";

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>
  <h3 class="mt-5">Insertar información PDO PHP y MySQL</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
<form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombres">Nombres</label>
      <input name="nombres" type="text" class="form-control" placeholder="Nombres">
    </div>
    <div class="form-group col-md-6">
      <label for="edad">Apellidos</label>
      <input name="apellidos" type="text" class="form-control" id="edad" placeholder="Apellidos">
    </div>
  </div>
<div class="form-row">  
    <div class="form-group col-md-6">
      <label for="profesion">Profesión</label>
      <input name="profesion" type="text" class="form-control" id="profesion" placeholder="Profesion">
    </div>

  <div class="form-group col-md-6">
    <label for="Estado">Estado</label>
    <select required name="estado" class="form-control" id="Estado">
    <option value=""><< >></option>
    <option value="Colombia">Colombia</option>
    <option value="Argentina">Argentina</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Peru">Peru</option>
    <option value="Brasil">Brasil</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Chile">Chile</option>
    </select>
  </div>

</div>
<div class="form-group">
  <button name="insertar" type="submit" class="btn btn-primary  btn-block">Guardar</button>
</div>
</form>
    </div>  
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->

<h1></h1>

<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="thead-dark">
    <th width="18%">Nombres</th>
    <th width="22%">Apellidos</th>
    <th width="22%">Profesión</th>
    <th width="14%">Estado</th>
    <th width="13%">Fecha registro</th>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM tbl_personal"; 
$query = $connect -> prepare($sql); 
$query -> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ); 

if($query -> rowCount() > 0)   { 
foreach($results as $result) { 
echo "<tr>
<td>".$result -> nombres."</td>
<td>".$result -> apellidos."</td>
<td>".$result -> profesion."</td>
<td>".$result -> estado."</td>
<td>".$result -> fregis."</td>
</tr>";

   }
 }
?>
</tbody>
</table>
</div>
</form>
   </div>  
  </div>
 

      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 
  
</div>
<!-- Fin container -->
<footer class="footer">
  <div class="container"> <span class="text-muted">

    </span> </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<script src="dist/js/bootstrap.min.js"></script> 
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>