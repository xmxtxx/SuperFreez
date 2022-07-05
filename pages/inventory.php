<?php

if (isset($_POST['Next'])) {

    include '../php/conection.php'; // Connection einfügen
    $conn = OpenCon();


    $invid = $_POST['invid'];
    $Name = $_POST['pname'];
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
if(isset($_POST['loeschen'])){

    include '../php/conection.php'; // Connection einfügen
    $conn = OpenCon();  
    $menge = $_POST['menge'];
    $minus = $_POST['lonumber'];
    $idw = $_POST['ddid'];

    $neuemenge = $menge-$minus;


    if($neuemenge == 0){
//löschen
    $regupd = "DELETE from produkt WHERE  Produktid= $idw";
        mysqli_query($conn, $regupd);
        $id = $_POST['id'];
    echo $id;
    header("Location: ./inventory.php?id=$id"); // weiterleitung
    }else{
        $regupd = "UPDATE produkt Set ProduktMenge = $neuemenge";
        mysqli_query($conn, $regupd);
        $id = $_POST['id'];
        echo $id;
        header("Location: ./inventory.php?id=$id"); // weiterleitung
    }


    

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
            <input type="text" value="<?php echo $_GET['id']; ?>" name="id" hidden>
            <input type="text" value="<?php echo $_GET['invid']; ?>" name="invid" hidden>
            <input type="submit" value="Hinzufuegen" name="Next">
        </form>

    <?php
    } else if ($_GET['Next'] == 2) {
        $invid = $_GET['invid'];
        echo $invid;
        include '../php/conection.php'; // Connection einfügen
        $conn = OpenCon();
        $sql5 = "SELECT * FROM produkt WHERE InventarId=$invid";
        $db_erg5 = mysqli_query($conn, $sql5);?>
    <form method = "POST">
        <?php while ($zeile5 = mysqli_fetch_array($db_erg5, MYSQLI_ASSOC)) {?>
            <input type="text" value="<?php echo $zeile5['Produktid']; ?>" name="ddid" hidden>
            <label for="lonumber">Anzahl der zulöschenden Exemplare für: <?php echo $zeile5['ProduktName'];?></label>
            <input type="number" name="lonumber" max="<?php echo $zeile5['ProduktMenge'] ?>" min="0"><br>
            <input type="text" value="<?php echo $zeile5['ProduktMenge']; ?>" name="menge" hidden>

<?php
        }
?>
    <input type="text" value="<?php echo $_GET['id']; ?>" name="id" hidden>
    <input type="submit" name="loeschen" value="Löschen">
    </form>
  <?php  }
    else{ 

    ?>
        <h1>Inventar</h1>
<a href="../index.php">Home</a>
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
                            <?php while ($zeile4 = mysqli_fetch_array($db_erg4, MYSQLI_ASSOC)) {
                                 echo $zeile4['ProduktName'] .", Art: ". $zeile4['ProduktArt'] . ", Verfallsdatum: ". $zeile4['ProduktVerfall']. ", Anzahl: ". $zeile4['ProduktMenge']."<br>"; 
                             } ?>
                        </td>
                        <td><a href="./inventory.php?id=<?php echo $id ?>&Next=1&invid='<?php echo $invid ?>'">Produkt Hinzufügen</a>
                            <a href="./inventory.php?id=<?php echo $id ?>&Next=2&invid='<?php echo $invid ?>'">Produkt Löschen</a>
                        </td>
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