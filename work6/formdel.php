<?php

include('functions.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['btn'];
    $db=DB_Connect();
    $statement = $db->prepare("SELECT id_form FROM Users where id=:id");
    $statement->execute(['id'=>"$id"]);
    $user = $statement->fetchAll();
    $id_form = $user[0]['id_form'];

    $statement = $db->prepare("DELETE FROM Users where id=:id");
    $statement->execute(['id'=>"$id"]);
    $statement = $db->prepare("DELETE FROM Person where id=:id");
    $statement->execute(['id'=>"$id_form"]);
    $statement = $db->prepare("DELETE FROM Connection where id=:id");
    $statement->execute(['id'=>"$id_form"]);
}

header("Location: admin.php");
exit();

?>