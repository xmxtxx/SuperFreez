<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperFreeze</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1>Meine SuperFreezer</h1>

    <a href="./pages/create.php">Hinzufügen</a>
    <!--Implementation Php!-->
    <table>
            <tr>
                <th>Name</th>
                <th> Infos </th>
            </tr>
    <?php
    include './php/conection.php'; // Connection einfügen
    $conn = OpenCon();
    $sql = "SELECT * FROM Freeze";

    $db_erg = mysqli_query($conn, $sql);
    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {

        $id = $zeile['FreezeId'];
    
        
    $sql2 = "SELECT * FROM fach WHERE FreezeId =$id";
    $db_erg2 = mysqli_query($conn, $sql2);
    ?>
   
            <tr>
                <td> <?php echo $zeile['FreezerName']; ?></td>
                <td>
                    <p>Anzahl Fächer:<?php
                    $i = 0;
                      while ($zeile2 = mysqli_fetch_array($db_erg2, MYSQLI_ASSOC)) {
                        $i++;
                     }
                
                     echo $i;?></p>
                    
                    <p>Inventar: <a href="./pages/inventory.php?id='<?php echo $id ?>'">Bearbeiten</a></p>
                    <p>Typ: <?php echo $zeile['Typ']; ?></p>
                    <p><a href="./pages/edit.php?id='<?php echo $id ?>'" class="option">SuperFreezer verwalten</a></p>
                </td>
            </tr>

    <?php
    } ?>

</table>



</body>

</html>