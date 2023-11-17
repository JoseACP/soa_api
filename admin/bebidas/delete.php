<?php

include("conexion.php");
$con=conectar();

$id=$_GET['id'];

$sql="DELETE FROM bebidas  WHERE id='$id'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: bebidas.php");
    }
?>
