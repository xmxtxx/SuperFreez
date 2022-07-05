<?php
session_start();

include './conection.php'; // Connection einfügen

$pwd = $_POST['passwort'];

$con = OpenCon();

$username = $_POST['user'];

$pass = password_hash($_POST['passwort'], PASSWORD_DEFAULT);

$kundenname = $_POST['kName'];

$s = " select * from kunde where username = '$name'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
	echo" Username wird schon Benutzt";

}else {
	$reg = " insert into kunde(KundeName , username , Passwort) values ('$kundenname' , '$username' , '$pass')";
	mysqli_query($con, $reg);
	header('location:../index.php');

}
	   
