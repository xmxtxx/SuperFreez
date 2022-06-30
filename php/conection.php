<?php 
function OpenCon(){
    $host ="localhost";
    $database="";
    $user="";
    $password="";


    $connection = new mysqli($host,$user,$password,$database) or die ("Datenbankverbindung Fehlgeschlagen");

    return $connection;
}

function CloseCon($con){
    $con -> close();
}

?>