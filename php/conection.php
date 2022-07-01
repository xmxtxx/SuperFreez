<?php 
function OpenCon(){
    $host ="localhost";
    $database="superfreezer";
    $user="root";
    $password="";


    $connection = new mysqli($host,$user,$password,$database) or die ("Datenbankverbindung Fehlgeschlagen");

    return $connection;
}

function CloseCon($con){
    $con -> close();
}

?>