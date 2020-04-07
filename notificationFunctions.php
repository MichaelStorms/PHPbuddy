<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__."/classes/db.php");

    function fetchAll($query){

        $conn = DB::getConnection();
        $statement = $conn->query($query);
        return $statement->fetchAll();
    }
    function performQuery($query){

        $conn = DB::getConnection();
        $statement = $conn->query($query);
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

?>