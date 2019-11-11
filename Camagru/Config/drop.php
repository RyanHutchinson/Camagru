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

echo"\033[01;31m Database has been removed from existance\n\033[0m";

?>