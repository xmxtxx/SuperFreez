<?php
$n = 1;
if(isset($_POST['Next'])){
$n=2;
}
if(isset($_POST['Next2'])){
  $n=3;
  }
  if(isset($_POST['Next3'])){
    $n=4;
    }  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neuer SuperFreezer</title>
</head>

<body>

<h2>SuperFreezer hinzufügen</h2>
<?php
if($n == 1){?>
    <form action="#" method="POST">
    <label for="fname">SuperFreezer Name:</label><br>
    <input type="text" id="fname" name="fname" required><br>
    <input type="radio" id="1" name="typ" value="1">
    <label for="1">1</label><br>
    <input type="radio" id="2" name="typ" value="2">
    <label for="2">2</label><br>
    <input type="submit" value="Next" name="Next">
  </form> 
       <?php }
        if($n == 2){
        //Freezer Erstellen
        include '../php/conection.php'; // Connection einfügen
        $conn = OpenCon();

        $Name = $_POST['fname'];
        $typ = $_POST['typ'];
        session_start();
        $kid = $_SESSION['id'];
        $reg = " insert into freeze(FreezerName , Typ, KundeId) values ('$Name' , '$typ', '$kid')";
        mysqli_query($conn, $reg);


        $sql2 = "SELECT * FROM freeze"; //sql abfrage
    
        $db_erg = mysqli_query($conn, $sql2); //verbinden
        
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) { //Auslesehen welche daten gespeichert worden sind
            $id = $zeile['FreezeId'];
        }     ?>
<form action="#" method="POST">
    <label for="fanzahl">Anzahl Fächer:</label><br>
    <input type="number" id="fanzahl" name="fanzahl" min="1" max="8" required><br>
    <input type="number" name="id" value="<?php echo $id ?>" hidden required><br>
    <input type="submit" value="Next" name="Next2">
  </form> 
<?php } if($n == 3){

$anzahl = $_POST['fanzahl'];
?>
<form action="#" method="POST">
<?php
for($i = 1; $i<=$anzahl;$i++){
  $s = "ftemp".$i;
  $s2 ="id".$i;
  ?>

    <label for="ftemp">Fach Temperatur:</label><br>
    <input type="number" id="ftemp" name="<?php echo $s; ?>" min="-40" max="0" required><br>
    <input type="number" name="<?php echo $s2 ?>" value="<?php echo $i ?>" hidden required><br>
    <input type="number" name="anzahl" value="<?php echo $anzahl ?>" hidden required><br>
<?php  }?>
<input type="number" name="id" value="<?php echo $_POST['id'] ?>" hidden required><br>
<input type="submit" value="Next" name="Next3">
</form> 
<?php


} if($n == 4){
  include '../php/conection.php'; // Connection einfügen
  $conn = OpenCon();
  for($i = 1; $i<=$_POST['anzahl'];$i++){
    //inventar
    $s = "ftemp".$i;
    $s2 ="id".$i;
    $temp = $_POST[$s];
    $id = $_POST['id'];
    $reg = " insert into fach(FachZahl, FreezeId, FachTemp) values ('$i' , '$id', '$temp')";
    mysqli_query($conn, $reg);



//inventar erstellen
    $sql2 = "SELECT * FROM fach"; //sql abfrage
    
        $db_erg = mysqli_query($conn, $sql2); //verbinden
        
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) { //Auslesehen welche daten gespeichert worden sind
            $id = $zeile['Fachid'];
        }  
    $reg = " insert into inventar(FachId) values ('$id')";
    mysqli_query($conn, $reg);
  }
  header('Location: ../index.php'); // weiterleitung

}
?>
        




  <?php  ?>
</body>

</html>