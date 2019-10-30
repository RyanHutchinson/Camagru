<?php

include("database.php");

function executeSQL($SQLstatement, $error, $conn){
    try{
        $db = $conn->prepare($SQLstatement);
        $db->execute();
    }catch(PDOException $e){
        echo $error . " has failed: " . $e->getMessage() . "<br />\n";
    }
}

$drop_database = "DROP DATABASE `camagru`;";

executeSQL($drop_database, "Deletion of database", $conn);

?>