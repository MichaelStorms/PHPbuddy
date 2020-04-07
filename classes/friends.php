<?php

include_once(__DIR__ . "/db.php");
include_once(__DIR__ . "/user.php");

class Buddy{

    // SEND FRIEND REQUEST
    public function sendRequest($requester_id, $requestee_id){
        
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO friendrequests (requesteeId, requesterId) VALUES ('".htmlspecialchars($requestee_id)."','".htmlspecialchars($_SESSION['user_id'])."')");
        $statement ->bindValue(":requesteeId", $requestee_id);
        $statement ->bindValue(":requesterId", $requester_id);
        $result = $statement->execute();

        return $result;
    }
}
?>



