<?php

include("conexion.php");
$con=conectar();

$id=$_GET['id'];

$sql="DELETE FROM tacos  WHERE id='$id'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tacos.php");
    }
?>
