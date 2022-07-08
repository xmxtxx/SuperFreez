<?php

if (isset($_POST['Senden'])) {
    include '../php/conection.php'; // Connection einfügen
    $conn = OpenCon();
    $freezId = $_POST['freezId'];

    $auslesehen2 = "SELECT * FROM fach WHERE FreezeId=$freezId";
    $auslesehen_erg2 = mysqli_query($conn, $auslesehen2);
    $i = 1;
    while ($zeile5 = mysqli_fetch_array($auslesehen_erg2, MYSQLI_ASSOC)) {
        $temp = $_POST['temp' . $i];
        $idw = $_POST['id' . $i];
        $regupd = "UPDATE fach Set FachTemp = $temp WHERE Fachid= $idw";
        mysqli_query($conn, $regupd);
        $i++;
    }
    header("Location: ../index.php"); // weiterleitung
}

if (isset($_POST['Next2'])) {
    $anzahl = $_POST['fanzahl'];
    header("Location: ./edit.php?id=" . $_GET['id'] . "&next=2&anzahl=" . $anzahl);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bearbeiten</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body><?php
        if (isset($_GET['next'])) {
            if ($_GET['next'] == 1) {
                include '../php/conection.php'; // Connection einfügen
                $conn = OpenCon();
                $freezId = $_GET['id'];

                $auslesehen3 = "SELECT * FROM fach WHERE FreezeId=$freezId";
                $auslesehen_erg3 = mysqli_query($conn, $auslesehen3);
                $i = 0;
                while ($zeile = mysqli_fetch_array($auslesehen_erg3, MYSQLI_ASSOC)) {
                    $i = $zeile['FachZahl'];
                }

                $hi = 8 - $i;


        ?>
            <form action="#" method="POST">
                <label for="fanzahl">Anzahl Fächer:</label><br>
                <input type="number" id="fanzahl" name="fanzahl" min="1" max="<?php echo $hi ?>" required><br>
                <input type="submit" value="Next" name="Next2">
            </form>
        <?php  }
            if ($_GET['next'] == 2) {
                $d = $_GET['anzahl']; ?>
            <form action="#" method="POST">
                <?php
                for ($i = 0; $i < $d; $i++) {
                    echo $hi; ?>

                    <label for="ftemp">Fach Temperatur:</label><br>
                    <input type="number" id="ftemp" name="<?php echo $s; ?>" min="-40" max="0" required><br>
                    <input type="number" name="jiwd" value="<?php echo $i ?>" hidden required><br>


                <?php  }
                ?>
                <input type="submit" value="Next" name="Next3">
            </form>
        <?php
            }
        } else {
        ?>
        <h1>Fachtemperatur bearbeiten</h1>
        <!-- <a href="./edit.php?id=<?php // echo $_GET['id'] ?>&next=1">Fach hinzufügen</a> -->

        <form method="POST">
            <?php
            include '../php/conection.php'; // Connection einfügen
            $conn = OpenCon();
            $freezId = $_GET['id'];
            $auslesehen = "SELECT * FROM fach WHERE FreezeId=$freezId";
            $auslesehen_erg = mysqli_query($conn, $auslesehen);
            $i = 1;
            while ($zeile5 = mysqli_fetch_array($auslesehen_erg, MYSQLI_ASSOC)) { ?>


                <label for="temp<?php echo $i ?>;">Temperatur für Fach: <?php echo $zeile5['FachZahl']; ?></label>
                <input type="number" name="temp<?php echo $i; ?>" value="<?php echo $zeile5['FachTemp']; ?>"><br>
                <input type="text" name="id<?php echo $i; ?>" value="<?php echo $zeile5['Fachid']; ?>" hidden>

            <?php $i++;
            }

            ?>
            <input type="text" name="freezId" value="<?php echo $freezId; ?>" hidden>
            <input type="submit" value="Senden" name="Senden">
        </form>
    <?php } ?>

</body>

</html>