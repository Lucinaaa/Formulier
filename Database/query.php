<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "form";

if(isset($_POST['submit'])){
    try{
        $pdoConnect = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $pdoConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $exc){
        echo $exc->getMessage();
        exit();
    }

    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];

    $query = "INSERT INTO `gegevens`(`voornaam`, `tussenvoegsel`, `achternaam`, `email`)
              VALUES (:voornaam,:tussenvoegsel,:achternaam,:email)";

    $pdoResult = $pdoConnect->prepare($query);

    $pdoExec = $pdoResult->execute
    (array(":voornaam"=>$voornaam,
           ":tussenvoegsel"=>$tussenvoegsel,
           ":achternaam"=>$achternaam,
           ":email"=>$email));

    if($pdoExec){
        echo'Data inserted';
    }
    else{
        echo'ERROR data';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<form action="query.php" method="post">
    <fieldset>
        <legend>Fill in!</legend>
        <label form="voornaam">Voornaam</label>
        <input type="text" id="voornaam" name="voornaam" required>
        <label form="tussenvoegsel">Tussenvoegsel</label>
        <input type="text" id="tussenvoegsel" name="tussenvoegsel">
        <label form="achternaam">Achternaam</label>
        <input type="text" id="achternaam" name="achternaam" required>
        <label form="email">E-mail</label>
        <input type="text" id="email" name="email" required>
        <input type="submit" value="Verzenden" name="submit">
    </fieldset>
</form>
</body>
</html>
