<?php

require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);$query = "SELECT * FROM friend";

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $firstname = trim(htmlentities($_POST['firstname'], ENT_QUOTES));
    $lastname = trim(htmlentities($_POST['lastname']));
    if($lastname && $firstname){
        $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
        $statement->execute();
        header("Location: index.php");
    }
}

$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach( $friends as $friend ): ?>
        <li><?= $friend["firstname"] ." ". $friend["lastname"] ?></li>
        <?php endforeach ?>
    </ul>
    <form action="" method="POST">
        <label for="firstname">firstname</label>
        <input type="text" name="firstname" id="firstname">
        
        <label for="lastname">lastname</label>
        <input type="text" name="lastname" id="lastname">
        
        <button type="submit">submit</button>
    </form>
</body>
</html>