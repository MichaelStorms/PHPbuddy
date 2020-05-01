<?php


include_once(__DIR__ . "/db.php");
include_once(__DIR__ . "/user.php");

class Chat extends User{
 
    /*private $chatTable = 'buddychat';
	private $chatUsersTable = 'cusers';
	private $chatLoginDetailsTable = 'chat_login_details';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }*/
	private function getData($sqlQuery) {
        $conn = Db::getConnection();
        $statement = $conn->prepare($sqlQuery);
		$result = $statement->execute();
		if(!$result){
			die('Error in query: '. PDO::errorInfo());
		}
		$data= array();
		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
    }
    
	private function getNumRows($sqlQuery) {
        $conn = Db::getConnection();
        $statement = $conn->prepare($sqlQuery);
		$result = $statement->execute();
		if(!$result){
			die('Error in query: '. PDO::errorInfo());
		}
		$numRows = $statement->fetchColumn();
		return $numRows;
	}/*
	public function loginUsers($email){
		$sqlQuery = "
			SELECT * 
			FROM users 
            WHERE email='$email' ";	
            

            
        return  $this->getData($sqlQuery);
	}*/
	public function chatUsers($id){
		$sqlQuery = "
			SELECT * FROM users 
			WHERE id != '$id'";
		return  $this->getData($sqlQuery);
	}
	public function getUserDetails($id){
		$sqlQuery = "
			SELECT * FROM users 
			WHERE id = '$id'";
		return  $this->getData($sqlQuery);
	}
	public function getUserAvatar($id){
		$sqlQuery = "
			SELECT image
			FROM users
			WHERE id = '$id'";
		$userResult = $this->getData($sqlQuery);
		$userAvatar = '';
		foreach ($userResult as $user) {
			$userAvatar = $user['image'];
		}	
		return $userAvatar;
	}	
	public function updateUserOnline($id, $online) {
        $conn = Db::getConnection();		
		$sqlUserUpdate = "
			UPDATE users 
			SET online = '$online' 
            WHERE id = '$id'";	
            
            $statement = $conn->prepare($sqlUserUpdate);
            $statement->execute();	
	}
	public function insertChat($reciever_id, $sender_id, $message) {		
		$conn = Db::getConnection();
		
		$sqlInsert = "
			INSERT INTO buddychat 
			(reciever_id, sender_id, message, status) 
			VALUES ('$reciever_id', '$sender_id', :message, '1')";

		$statement = $conn->prepare($sqlInsert);
	//	$msg = $message;
		$statement->bindParam(":message",$message);
        $result = $statement->execute();	
		if(!$result){
			return ('Error in query: '. PDO::errorInfo());
		} else {
			$conversation = $this->getUserChat($sender_id, $reciever_id);
			$data = array(
				"conversation" => $conversation			
			);
			echo json_encode($data);	
		}
	}
	public function getUserChat($from_user_id, $to_user_id) {

		$fromUserAvatar = $this->getUserAvatar($from_user_id);	
		$toUserAvatar = $this->getUserAvatar($to_user_id);			
		$sqlQuery = "
			SELECT * FROM buddychat 
			WHERE (sender_id = '".$from_user_id."' 
			AND reciever_id = '".$to_user_id."') 
			OR (sender_id = '".$to_user_id."' 
			AND reciever_id = '".$from_user_id."') 
			ORDER BY timestamp ASC";
		$userChat = $this->getData($sqlQuery);	
		$conversation = '<ul>';
		foreach($userChat as $chat){
			$user_name = '';
			if($chat["sender_id"] == $from_user_id) {
				$conversation .= '<li class="sent">';
				$conversation .= '<img width="22px" height="22px" src="userpics/'.$fromUserAvatar.'" alt="" />';
			} else {
				$conversation .= '<li class="replies">';
				$conversation .= '<img width="22px" height="22px" src="userpics/'.$toUserAvatar.'" alt="" />';
			}			
			$conversation .= '<p>'.$chat["message"].'</p>';			
			$conversation .= '</li>';
		}		
		$conversation .= '</ul>';
		return $conversation;
	}
	public function showUserChat($from_user_id, $to_user_id) {	
        $conn = Db::getConnection();	
		$userDetails = $this->getUserDetails($to_user_id);
		$toUserAvatar = '';
		foreach ($userDetails as $user) {
			$toUserAvatar = $user['image'];
			$userSection = '<img src="userpics/'.$user['image'].'" alt="" />
				<p>'.$user['firstname'].'</p>
				<div class="social-media">
					<i class="fa fa-facebook" aria-hidden="true"></i>
					<i class="fa fa-twitter" aria-hidden="true"></i>
					 <i class="fa fa-instagram" aria-hidden="true"></i>
				</div>';
		}		
		// get user conversation
		$conversation = $this->getUserChat($from_user_id, $to_user_id);	
		// update chat user read status		
		$sqlUpdate = "
			UPDATE buddychat
			SET status = '0' 
			WHERE sender_id = '$to_user_id' AND reciever_id = '$from_user_id' AND status = '1'";
        $statement = $conn->prepare($sqlUpdate);
        $statement->execute();
		// update users current chat session
		$sqlUserUpdate = "
			UPDATE users
			SET current_session = '$to_user_id' 
			WHERE id = '$from_user_id'";
            $statement = $conn->prepare($sqlUserUpdate);
            $statement->execute();
            
            $data = array(
			"userSection" => $userSection,
			"conversation" => $conversation			
		 );
		 echo json_encode($data);		
	}	
	public function getUnreadMessageCount($sender_id, $reciever_id) {
		$sqlQuery = "
			SELECT * FROM buddychat  
			WHERE sender_id = '$sender_id' AND reciever_id = '$reciever_id' AND status = '1'";
		$numRows = $this->getNumRows($sqlQuery);
		$output = '';
		if($numRows > 0){
			$output = $numRows;
		}
		return $output;
	}	
	public function updateTypingStatus($is_type, $loginDetailsId) {		
        $conn = Db::getConnection();
		$sqlUpdate = "
			UPDATE chat_login_details
			SET is_typing = '$is_type' 
			WHERE id = '$loginDetailsId'";
        $statement = $conn->prepare($sqlUpdate);
        $statement->execute();
	}		
	public function fetchIsTypeStatus($userId){
		$sqlQuery = "
		SELECT is_typing FROM chat_login_details
		WHERE userid = '$userId' ORDER BY last_activity DESC LIMIT 1"; 
		$result =  $this->getData($sqlQuery);
		$output = '';
		foreach($result as $row) {
			if($row["is_typing"] == 'yes'){
				$output = ' - <small><em>Typing...</em></small>';
			}
		}
		return $output;
	}		
	public function insertUserLoginDetails($UserId) {		
        $conn = Db::getConnection();
		$sqlInsert = "
			INSERT INTO chat_login_details(userid) 
            VALUES ('$UserId')";
        $statement = $conn->prepare($sqlInsert);
        $statement->execute();
        $id = $conn->lastInsertId();
        
        return $id;		
	}	
	public function updateLastActivity($loginDetailsId) {	
        $conn = Db::getConnection();
	
		$sqlUpdate = "
			UPDATE chat_login_details 
			SET last_activity = now() 
			WHERE id = '$loginDetailsId'";
        $statement = $conn->prepare($sqlUpdate);
        $statement->execute();

	}	
	public function getUserLastActivity($userId) {
		$sqlQuery = "
			SELECT last_activity FROM chat_login_details 
			WHERE userid = '$userId' ORDER BY last_activity DESC LIMIT 1";
		$result =  $this->getData($sqlQuery);
		foreach($result as $row) {
			return $row['last_activity'];
		}
	}	
}
?>