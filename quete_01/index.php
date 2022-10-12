<?php
require 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

if(!empty($_POST)){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);                                    
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);                                                 /* pourquoi ca rajoute un nom au refresh de page*/
    $statement->execute();
    header("Location: /index.php");
}                                                                                                               

$query = "SELECT * FROM  friend";
$statement = $pdo->query($query);
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);
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
        <?php foreach($friendsArray as $friend) 
        {
        echo $friend['firstname'] . ' ' . $friend['lastname'] . "<br />";
        }?>
    </ul>

    <form action="" method = "POST"> 
        <label for="name">Prénom:</label><br />
        <input type="text" id="firstname"name="firstname" required><br />

        <label for="name">Nom:</label><br />
        <input type="lastName" id="lastname"name="lastname" required><br />
        <input type="submit" value="insert">
    </form>
</body>
</html>
