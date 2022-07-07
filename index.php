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
<?php 
session_start();
if(!isset($_SESSION['logged'])){
    $_SESSION['logged'] = false;
}
    if($_SESSION['logged'] != true){

        ?>
      <h1>Login</h1>
              <form action="./php/authenticate.php" method="post">
                  <input type="text" name="username" placeholder="username" required><br>
                  <input type="password" name="passwordl" placeholder="Password" required><br>
                 <button type="submit" name="submit">Login</button>
              </form>

              <h1>Register</h1>
              <form action="./php/register.php" method="post">
                  <input type="text" name="user" placeholder="username" required><br>
                  <input type="password" name="passwort" placeholder="passwort" required><br>
                <input type="text" name="kName" placeholder="Max Mustermann" register>
                 <button type="submit" name="submit">Register</button>
              </form>
<?php


    }else{

?>

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

    $kid = $_SESSION['id'];
    $sql = "SELECT * FROM Freeze WHERE KundeId=$kid";

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


<?php }?>
</body>

</html>