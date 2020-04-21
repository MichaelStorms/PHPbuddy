<?php

include_once(__DIR__ . "/db.php");
include_once(__DIR__ . "/user.php");

class Buddy{

    // SEND FRIEND REQUEST
    public function sendRequest($requester_id, $requestee_id){
        
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO friendrequests (requesteeId, requesterId) VALUES ('".htmlspecialchars($requestee_id)."','".htmlspecialchars($_SESSION['id'])."')");
        $statement ->bindValue(":requesteeId", $requestee_id);
        $statement ->bindValue(":requesterId", $requester_id);
        $result = $statement->execute();

        return $result;
    }

    public static function getAll(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * FROM friends WHERE Buddies");
        $statement->execute();
        $buddies = $statement->fetch(PDO::FETCH_ASSOC);

        return $buddies;
    }
      // CHECK IF ALREADY FRIENDS
      public function is_already_friends($my_id, $id){
        $conn = Db::getConnection();

        try{
            $sql = "SELECT * FROM `friends` WHERE (user_one = :my_id AND user_two = :frnd_id) OR (user_one = :frnd_id AND user_two = :my_id)";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->bindValue(':frnd_id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
        
    }

    //  IF I AM THE REQUEST SENDER
    public function am_i_the_req_sender($my_id, $id){
        $conn = Db::getConnection();

        try{
            $sql = "SELECT * FROM `friend_request` WHERE sender = ? AND receiver = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$my_id, $id]);

            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //  IF I AM THE RECEIVER 
    public function am_i_the_req_receiver($my_id, $id){
        $conn = Db::getConnection();

        try{
            $sql = "SELECT * FROM `friend_request` WHERE sender = ? AND receiver = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id, $my_id]);

            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // CHECK IF REQUEST HAS ALREADY BEEN SENT
    public function is_request_already_sent($my_id, $id){
        $conn = Db::getConnection();

        try{
            $sql = "SELECT * FROM `friend_request` WHERE (sender = :my_id AND receiver = :frnd_id) OR (sender = :frnd_id AND receiver = :my_id)";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->bindValue(':frnd_id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            if($stmt->rowCount() === 1){
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // MAKE PENDING FRIENDS (SEND FRIEND REQUEST)
    public function make_pending_friends($my_id, $id){
        $conn = Db::getConnection();

        try{
            $sql = "INSERT INTO `friend_request`(sender, receiver) VALUES(?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$my_id, $id]);
            header('Location: UserFriendProfile.php?id='.$id);
            exit;
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // CANCEL FRIEND REQUEST
    public function cancel_or_ignore_friend_request($my_id, $id){
        $conn = Db::getConnection();

        try{
            $sql = "DELETE FROM `friend_request` WHERE (sender = :my_id AND receiver = :frnd_id) OR (sender = :frnd_id AND receiver = :my_id)";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->bindValue(':frnd_id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header('Location: UserFriendProfile.php?id='.$id);
            exit;
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // MAKE FRIENDS
    public function make_friends($my_id, $id){
        $conn = Db::getConnection();

        try{

            $delete_pending_friends = "DELETE FROM `friend_request` WHERE (sender = :my_id AND receiver = :frnd_id) OR (sender = :frnd_id AND receiver = :my_id)";
            $delete_stmt = $conn->prepare($delete_pending_friends);
            $delete_stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $delete_stmt->bindValue(':frnd_id', $id, PDO::PARAM_INT);
            $delete_stmt->execute();
            if($delete_stmt->execute()){

                $sql = "INSERT INTO `friends`(user_one, user_two) VALUES(?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$my_id, $id]);
                header('Location: UserFriendProfile.php?id='.$id);
                exit;
                
            }            
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }
    // DELETE FRIENDS 
    public function delete_friends($my_id, $id){
        $conn = Db::getConnection();

        try{
            $delete_friends = "DELETE FROM `friends` WHERE (user_one = :my_id AND user_two = :frnd_id) OR (user_one = :frnd_id AND user_two = :my_id)";
            $delete_stmt = $conn->prepare($delete_friends);
            $delete_stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $delete_stmt->bindValue(':frnd_id', $id, PDO::PARAM_INT);
            $delete_stmt->execute();
            header('Location: UserFriendProfile.php?id='.$id);
            exit;
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // REQUEST NOTIFICATIONS
    public function request_notification($my_id, $send_data){
        $conn = Db::getConnection();

        try{
            $sql = "SELECT sender, firstname, lastname, image FROM `friend_request` JOIN users ON friend_request.sender = users.id WHERE receiver = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$my_id]);
            if($send_data){
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return $stmt->rowCount();
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

    }


    public function get_all_friends($my_id, $send_data){
        $conn = Db::getConnection();

        try{
            $sql = "SELECT * FROM `friends` WHERE user_one = :my_id OR user_two = :my_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':my_id',$my_id, PDO::PARAM_INT);
            $stmt->execute();

                if($send_data){

                    $return_data = [];
                    $all_users = $stmt->fetchAll(PDO::FETCH_OBJ);

                    foreach($all_users as $row){
                        if($row->user_one == $my_id){
                            $get_user = "SELECT id, firstname, lastname, image FROM users WHERE id = ?";
                            $get_user_stmt = $conn->prepare($get_user);
                            $get_user_stmt->execute([$row->user_two]);
                            array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ));
                        }else{
                            $get_user = "SELECT id, firstname, lastname, image FROM users WHERE id = ?";
                            $get_user_stmt = $conn->prepare($get_user);
                            $get_user_stmt->execute([$row->user_one]);
                            array_push($return_data, $get_user_stmt->fetch(PDO::FETCH_OBJ));
                        }
                    }

                    return $return_data;

                }
                else{
                    return $stmt->rowCount();
                }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>



