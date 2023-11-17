<?php 
    include("conexion.php");
    $con=conectar();

    $sql="SELECT *  FROM tacos";
    $query=mysqli_query($con,$sql);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/logo-toro.ico">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="table.css">
    
    <title>Rincón Ganadero</title>
</head>
<body>
<nav> 

<div class="nav-img">
    <img src="../img/logo-toro.png">
</div>

<div class="nav-bttns">
    
<a href="#">Tacos</a>
    <a href="../complementos/complementos.php">Complementos</a>
    <a href="../bebidas/bebidas.php">Bebidas</a>
    <a href="../cortes/cortes.php">Cortes</a>
    <a href="../ensaladas/ensaladas.php">Ensaladas</a>
    <a href="../entradas/entradas.php">Entradas</a>
    <a href="../fuertes/fuertes.php">Fuertes</a>
    <a href="../infantiles/infantiles.php">Infantiles</a>
    <!-- <a href="">Bttn</a> -->

</div>
<div class="nav-whats">
			<a href="../includes/logout.php">
            <svg class="nav-whats-img" fill="#000000" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490.3 490.3" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M0,121.05v248.2c0,34.2,27.9,62.1,62.1,62.1h200.6c34.2,0,62.1-27.9,62.1-62.1v-40.2c0-6.8-5.5-12.3-12.3-12.3 s-12.3,5.5-12.3,12.3v40.2c0,20.7-16.9,37.6-37.6,37.6H62.1c-20.7,0-37.6-16.9-37.6-37.6v-248.2c0-20.7,16.9-37.6,37.6-37.6h200.6 c20.7,0,37.6,16.9,37.6,37.6v40.2c0,6.8,5.5,12.3,12.3,12.3s12.3-5.5,12.3-12.3v-40.2c0-34.2-27.9-62.1-62.1-62.1H62.1 C27.9,58.95,0,86.75,0,121.05z"></path> <path d="M385.4,337.65c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6l83.9-83.9c4.8-4.8,4.8-12.5,0-17.3l-83.9-83.9 c-4.8-4.8-12.5-4.8-17.3,0s-4.8,12.5,0,17.3l63,63H218.6c-6.8,0-12.3,5.5-12.3,12.3c0,6.8,5.5,12.3,12.3,12.3h229.8l-63,63 C380.6,325.15,380.6,332.95,385.4,337.65z"></path> </g> </g> </g></svg>
			</a>

			
		</div>


</nav>

<div class="banner">
		<div class="banner-cont">
			<div class="banner-img">
				<img src="img/logo2.png">

			</div>
		</div>
		
	</div>


<div class="patron" style="position: absolute; right:0; backdrop-filter: blur(15px); border-radius: 15px;">
    
    <img src="img/dsi-removebg-preview.png" alt="" style="height: 75px;">
    <img src="img/LogotipoSIR-med.png" alt="" style="height: 75px;">
    <img src="img/jagueza.png" alt="" style="height: 75px;">
</div>

<div class="tabla-container">
    <table class="tabla">
        <thead>
        <tr><th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Costo</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
              <?php
                  while($row=mysqli_fetch_array($query)){
              ?>
                  <tr>
                      <th><?php  echo $row['id']?></th>
                      <th><?php  echo $row['nombre']?></th>
                      <th><?php  echo $row['descripcion']?></th>
                      <th><?php  echo $row['precio']?></th>  
                      <th><a href="actualizar.php?id=<?php echo $row['id'] ?>" class="info">Editar</a></th>
                      <th><a href="delete.php?id=<?php echo $row['id'] ?>" class="danger">Eliminar</a></th>                                        
                  </tr>
              <?php 
                  }
              ?> 
              <a href="datos.php" class="insert">Agregar nuevo registro</a>
      </tbody> 
     
      </table>
      
  </div>
 
</body>
</html>