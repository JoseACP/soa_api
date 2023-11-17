<?php
include("conexion.php");
$con=conectar();

$id=$_POST['id'];
$name=$_POST['name'];
$description=$_POST['description'];
$cost=$_POST['cost'];


$sql="INSERT INTO cortes VALUES('$id','$name','$description','$cost')";
$query= mysqli_query($con,$sql);

if($query){
    Header("Location: cortes.php");
    echo '<script type="text/javascript">
    alert("¡Registro agregado!");
    </script>';
    
}else {
}
?>