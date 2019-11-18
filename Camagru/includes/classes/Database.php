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

    public static function query($query, $params = array(), $types = array()) {
        $statement = self::connect()->prepare($query);
        if (empty($types))
            $statement->execute($params);
        else {
            for($i = 0; $i < count($params); $i++){
                $statement->bindParam($i + 1, $params[$i], $types[$i]);
            }
            $statement->execute();
        }
        if (explode(' ', $query)[0] == 'SELECT'){
            return ($statement->fetchALL());
            //return($data);
        }
    }
}
?>