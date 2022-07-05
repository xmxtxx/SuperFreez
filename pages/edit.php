
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperFreeze</title>
</head>
<body>
    <h1>SuperFreeze bearbeitung</h1>
<?php
include '../php/conection.php'; // Connection einfügen
    $conn = OpenCon();
   // $sqlStatement = "SELECT MAX(fachId) FROM Fach";
    //$sqlAblauf = "SELECT * from Produkt where ProduktAblauf >= NOW() ORDER BY ProduktAblauf Limit 1 ";
    //$sqlUpdate = "UPDATE Freeze SET FreezerName='' where FreezeId=1 ";
    $id = $_GET['id'];
    $sql = "SELECT * FROM freeze WHERE FreezeId=$id";
    $db_erg = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM fach WHERE FreezeId=$id";    
    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {?>
    
 <form action="edit.php" method="post">
 <label for="FreezerName">Freezer Name:</label>
       <input type="text" name="FreezerName" id="FreezerName" value="<?php echo $zeile['FreezerName'] ?>"> <br> 
    <label for= "typ">Typ:</Label>
        <input type="text" name ="typ" id="typ" value="<?php echo $zeile['Typ']?>">


        <br>
        <input type="text" name="id" value="<?php echo $_GET['id']; ?>" hidden>
       <button type="submit" value="Bestätigen" name="Bestätigen">Bestätigen</button>
       <button type="submit" value="loeschen" name="loeschen">Löschen</button>
    <form>
    <?php }?>

    <?php
    
    if(isset($_POST['Bestätigen'])){
        $fname = mysqli_real_escape_string($conn, $_POST['FreezerName']);
        //$fname = $_POST['FreezerName'];
        
    $id = $_POST['id'];
            $reg2 = "UPDATE freeze SET FreezerName = '$fname' WHERE FreezeId=$id";
            echo $reg2;  

        mysqli_query($conn, $reg2);
        header('Location: ../index.php');
    }
    if (isset($_POST['Loeschen'])){
            
        $loeschen = "DELETE * from freeze where id = '$id' limit=1 ";

        mysqli_query($conn,$loeschen);
        header('Location: ../index.php');


    }
    ?>
</body>
</html>