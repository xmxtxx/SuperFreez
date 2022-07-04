<?php 

if(isset($_POST['Next'])){
  
    include '../php/conection.php'; // Connection einfügen
    $conn = OpenCon();

    
    $invid = $_POST['invid'];
    $Name= $_POST['pname'];
    $ablauf = $_POST['pablauf'];
    $verfall = $_POST['pverfall'];
    $menge = $_POST['pmenge'];
    $art = $_POST['produktart'];

    $reg = " insert into produkt(InventarId, ProduktName, ProduktAblauf, ProduktVerfall, ProduktMenge, ProduktArt) values ($invid, '$Name', '$ablauf', '$verfall', '$menge', '$art')";
    echo $reg;
    mysqli_query($conn, $reg);
    $id = $_POST['id'];
    echo $id;
    header("Location: ./inventory.php?id=$id"); // weiterleitung
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventar</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    if ($_GET['Next'] == 1) { ?>

        <form action="#" method="POST">
            <label for="pname">Produkt Name:</label><br>
            <input type="text" id="pname" name="pname" required><br>
            <label for="pablauf">Produkt Ablaufdatum:</label><br>
            <input type="date" id="pablauf" name="pablauf" required><br>
            <label for="pverfall">Produkt Verfallsdatum:</label><br>
            <input type="date" id="pverfall" name="pverfall" required><br>
            <label for="pmenge">Produkt Menge</label><br>
            <input type="number" id="pmenge" name="pmenge" min=1 value="1" required><br>
            <label for="produktart">Produkt Art:</label>
            <select name="produktart">
                <option value="Fleisch">Fleisch</option>
                <option value="Gemuese">Gemuese</option>
                <option value="Gefluegel">Gefluegel</option>
                <option value="Fisch">Fisch</option>
                <option value="Eis">Eis</option>
                <option value="Gebaeck">Gebaeck</option>
                <option value="Milch">Milch</option>
                <option value="Auftauen">Auftauen</option>
            </select>
            <input type="text" value="<?php echo $_GET['id'];?>" name="id" hidden>
            <input type="text" value="<?php echo $_GET['invid'];?>" name="invid" hidden>
            <input type="submit" value="Hinzufuegen" name="Next">
        </form>

    <?php
    } else {

    ?>
        <h1>Inventar</h1>
        <table>
            <tr>
                <th>FreezerName</th>
                <th> FachNummer </th>
                <th> Inhalt</th>
                <th></th>
            </tr>
            <?php

            include '../php/conection.php'; // Connection einfügen
            $conn = OpenCon();

            $id = $_GET['id'];
            $sql = "SELECT * FROM fach WHERE FreezeId=$id";
            $db_erg = mysqli_query($conn, $sql);

            while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
                $fachid = $zeile['Fachid'];
                $freid =  $zeile['FreezeId'];

                $sql3 = "SELECT * FROM inventar WHERE FachId=$fachid";
                $db_erg3 = mysqli_query($conn, $sql3);
                while ($zeile3 = mysqli_fetch_array($db_erg3, MYSQLI_ASSOC)) {

                    $invid = $zeile3['InventarId'];
                }
                $sql2 = "SELECT * FROM freeze WHERE FreezeId=$freid";
                $db_erg2 = mysqli_query($conn, $sql2);


                $sql4 = "SELECT * FROM produkt WHERE InventarId=$invid";
                $db_erg4 = mysqli_query($conn, $sql4);

            
                

                while ($zeile2 = mysqli_fetch_array($db_erg2, MYSQLI_ASSOC)) { ?>
                    <tr>
                        <td> <?php echo $zeile2['FreezerName']; ?></td>
                        <td><?php echo $zeile['FachZahl']; ?></td>
                        <td>
                    <?php    while ($zeile4 = mysqli_fetch_array($db_erg4, MYSQLI_ASSOC)) {
                                 $name = $zeile4['ProduktName'];
                                 $pArt = $zeile4['ProduktArt'];?>
                        <?php echo $zeile4['ProduktName']."<br>";?>
                        <?php }?>
                        </td>
                        <td><a href="./inventory.php?id=<?php echo $id ?>&Next=1&invid='<?php echo $invid ?>'">Produkt Hinzufügen</a></td>
                    </tr>
            <?php
                }
            }
        



            ?>

        </table>
    <?php }
    ?>
</body>

</html>