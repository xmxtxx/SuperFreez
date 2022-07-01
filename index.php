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

    <a href="#">Hinzufügen</a>
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

    ?>
   
            <tr>
                <td> <?php echo $zeile['FreezerName']; ?></td>
                <td>
                    <p>Anzahl Fächer: 5</p>
                    <p>Inventar: 95%</p>
                    <p>Typ: <?php echo $zeile['Typ']; ?></p>
                    <p><a href="#" class="option">SuperFreezer verwalten</a></p>
                </td>
            </tr>

    <?php
    } ?>

</table>



</body>

</html>