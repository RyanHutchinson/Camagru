<?php

class Database{

    public static function connect(){
        try{
        $pdo = new PDO('mysql:host=localhost:3306;dbname=camagru;charset=utf8', 'admin', '1234');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return($pdo);
        }catch(PDOException $e){
            echo $e->getMessage();
            return NULL;
        }
    }

    public static function query($query, $params = array()){
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(' ', $query)[0] == 'SELECT'){
            $data = $statement->fetchALL();
            return($data);
        }
    }
}
?>