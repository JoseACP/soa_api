<?php 
    include("conexion.php");
    $con=conectar();

$id=$_GET['id'];

$sql="SELECT * FROM bebidas WHERE id='$id'";
$query=mysqli_query($con,$sql);

$row=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="proto_form.css" />
    <title>Formulario Prototipos</title>
  </head>
  <body>
    <!-- Botón volver -->
    <div class="wrap">
    <a class="button" href='bebidas.php' style="padding: 15px; text-decoration: none;">Volver</a>
    </div>
        <!--  -->
    <div class="login-page">
      <div class="form">
        <form action="update.php" method="post" class="login-form">
        <input type="hidden" name="id" value="<?php echo $row['id']  ?>">
        <h4>Nombre</h4>
        <input type="text" class="form-control mb-3" name="na"  value="<?php echo $row['nombre']  ?>">
        <h4>Descripción</h4>
        <input type="text" class="form-control mb-3" name="descriptio" value="<?php echo $row['descripcion']  ?>">
        <h4>Precio</h4>
        <input type="text" class="form-control mb-3" name="cost" placeholder="Precio" value="<?php echo $row['precio']  ?>">
          <button type="submit" name="register" id="enviar" value="Actualizar">Enviar</button>
        </form>
      </div>
    </div>
  </body>
</html>

<!--<script>function test(){
    $.ajax({url:"count.php", success:function(result){
    $("div").text(result);}
})
} </script>-->

