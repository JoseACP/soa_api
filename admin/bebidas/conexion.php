<?php
function conectar(){
    $host="localhost";
    $user="u217482256_rincon2023";
    $pass="Rincon2023";

    $bd="u217482256_rincon";

    $con=mysqli_connect($host,$user,$pass);

    mysqli_select_db($con,$bd);

    return $con;
}
?>
