<?php
class DB{
        private static function connect(){
            $pdo = new PDO('mysql:host=localhost;dbname=lets-hike;charset=utf8mb4;collation=utf8_general_ci', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //PDO::ATTR_EMULATE_PREPARES:
            //https://stackoverflow.com/questions/134099/are-pdo-prepared-statements-sufficient-to-prevent-sql-injection
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        }
        public static function query($query, $params = array()){
            //PDO real escape strings:
            //https://stackoverflow.com/questions/3716373/real-escape-string-and-pdo
            //self:  to access non-static members of a class(variables or functions) for the current object.
            //prepare: A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency. 
            $statement = self::connect()->prepare($query);
            $statement->execute($params);
            //Explode: Break a string into an array
            if(explode(' ', $query)[0] == 'SELECT'){
                //FetchAll: returns an array containing all of the remaining rows in the result set. 
            $data = $statement->fetchAll();
            return $data;
            }
    }
}
?>
