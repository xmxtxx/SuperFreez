
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperFreeze</title>
</head>
<body>
<?php
include '../php/conection.php'; // Connection einfügen
    $conn = OpenCon();
   // $sqlStatement = "SELECT MAX(fachId) FROM Fach";
    //$sqlAblauf = "SELECT * from Produkt where ProduktAblauf >= NOW() ORDER BY ProduktAblauf Limit 1 ";
    //$sqlUpdate = "UPDATE Freeze SET FreezerName='' where FreezeId=1 "
    $sql = "SELECT * FROM Freeze";
    $db_erg = mysqli_query($conn, $sql);
    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {?>
 <form action="Freezer" method="post">
 <label for="fname">Freezer Name:</label>
       <input type="FName" name="FName" id="FName" value="<?php $zeile['FreezerName'] ?>"> 

       <input type="submit" value="Bestätigen">
    <form>
    <?php }?>
</body>
</html>