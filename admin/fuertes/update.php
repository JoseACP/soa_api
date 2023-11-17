<?php

include("conexion.php");
$con=conectar();

$id=$_POST['id'];
$name=$_POST['na'];
$description=$_POST['descriptio'];
$cost=$_POST['cost'];

$sql="UPDATE fuertes SET  nombre='$name',descripcion='$description',precio='$cost' WHERE id='$id'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: fuertes.php");
    }
?>