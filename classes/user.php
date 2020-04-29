<?php

include_once(__DIR__ . "/db.php");

class User
{
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $class;
    protected $buddy;
    private $locatie;
    private $course;
    private $hobby;
    private $extra;
    private $image;
    private $description;


    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new Exception("this cant be empty");
        }
        $this->email = $email;

        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

/**
     * Get the value of location
     */ 
    public function getLocatie()
    {
        return $this->locatie;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocatie($locatie)
    {
        $this->locatie = $locatie;

        return $this;
    }

    /**
     * Get the value of course
     */ 
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set the value of course
     *
     * @return  self
     */ 
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get the value of hobby
     */ 
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * Set the value of hobby
     *
     * @return  self
     */ 
    public function setHobby($hobby)
    {
        $this->hobby = $hobby;

        return $this;
    }

    /**
     * Get the value of extra
     */ 
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set the value of extra
     *
     * @return  self
     */ 
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get the value of class
     */ 
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the value of class
     *
     * @return  self
     */ 
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

        /**
     * Get the value of buddy
     */ 
    public function getBuddy()
    {
        return $this->buddy;
    }

    /**
     * Set the value of buddy
     *
     * @return  self
     */ 
    public function setBuddy($buddy)
    {
        $this->buddy = $buddy;

        return $this;
    }

/**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }



    public function save()
    {
        $conn = Db::getConnection();

        $statement = $conn->prepare("insert into users (firstname, lastname, email, password, class, buddy) values (:firstname, :lastname, :email, :password , :class, :buddy)");

        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $class = $this->getClass();
        $buddy = $this->getBuddy();

        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":class",$class);
        $statement->bindValue(":buddy",$buddy);

        $result = $statement->execute();

        return $result;
    }
    public static function checkDouble($email)
    {
        $conn = DB::getConnection();

        $statement = $conn->prepare("SELECT * FROM users WHERE email=:email");
        $statement->bindParam(":email",$email); //$conn->query kan ook
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function canLogin($email, $enteredPassword)
    {
        $password = $this->getPasswordByEmail($email);

        if (password_verify($enteredPassword, $password)) {
            return true;
        } else {
            return false;
        }
    }


    private function getPasswordByEmail($email)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT password FROM users where email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();

        $result = $statement->fetch();

        return $result['password'];
    }

    public function updateProfile()
    {
        $email = trim($_SESSION['user']); 

        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET locatie = :locatie, interests = :course, hobby = :hobby, extra = :extra, class = :class, buddy = :buddy WHERE email = '$email'"); //:email moet voor een of andere reden.

        $locatie = $this->getLocatie();
        $course = $this->getCourse();
        $hobby = $this->getHobby();
        $extra = $this->getExtra();
        $class = $this->getClass();
        $buddy = $this->getBuddy();

        $statement->bindParam(":locatie", $locatie);
        $statement->bindParam(":course", $course);
        $statement->bindParam(":hobby", $hobby);
        $statement->bindParam(":extra", $extra);
        $statement->bindParam(":class", $class);
        $statement->bindParam(":buddy", $buddy);
      //  $statement->bindParam(":email", $email);
        

        $result = $statement->execute();

        return $result;
    }
    public function updateProfileNoClassBuddy()
    {
        $email = trim($_SESSION['user']); 

        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET locatie = :locatie, interests = :course, hobby = :hobby, extra = :extra WHERE email = '$email'"); //:email moet voor een of andere reden.

        $locatie = $this->getLocatie();
        $course = $this->getCourse();
        $hobby = $this->getHobby();
        $extra = $this->getExtra();


        $statement->bindParam(":locatie", $locatie);
        $statement->bindParam(":course", $course);
        $statement->bindParam(":hobby", $hobby);
        $statement->bindParam(":extra", $extra);

      //  $statement->bindParam(":email", $email);
        

        $result = $statement->execute();

        return $result;
    }
    public static function getUser($email){
        
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users where email ='$email'");
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }



     // FIND USER BY ID
     function find_user_by_id($id){
        $conn = Db::getConnection();
        try{
            $find_user = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $find_user->execute([$id]);
            if($find_user->rowCount() === 1){
                return $find_user->fetch(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    function all_users($id){
        $conn = Db::getConnection();
        try{
            $get_users = $conn->prepare("SELECT id, firstname, lastname, image FROM users WHERE id != ?");
            $get_users->execute([$id]);
            if($get_users->rowCount() > 0){
                return $get_users->fetchAll(PDO::FETCH_OBJ);
            }
            else{
                return false;
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function userUpdatePassword()
    {
        $email = trim($_SESSION['user']);

        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET password = :password WHERE email = '$email'");
        
        $password = $this->getPassword();

        $statement->bindParam(":password", $password);

        $result = $statement->execute();
        return $result;
    }

    public function passwordCheck($email, $enteredPassword)
    {
        $password = $this->getPasswordByEmail($email);

        if (password_verify($enteredPassword, $password)) {
            return true;
        } else {
            return false;
        }
    }

    public function userUpdateEmail()
    {
        
        $email = trim($_SESSION['user']);

        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET email = :emailNew WHERE email = '$email'");
        $emailNew = $this->getEmail();
        
        
        $statement->bindParam(":emailNew", $emailNew);

        $result = $statement->execute();

        return $result;
    }

    public function userUpdateImage()
    {
        $email = trim($_SESSION['user']);

        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET image = :image WHERE email = '$email'");
        $image = $this->getImage();
        
        
        $statement->bindParam(":image", $image);

        $result = $statement->execute();

        return $result;
    }

    public function userUpdateDescription()
    {
        
        $email = trim($_SESSION['user']);

        $conn = Db::getConnection();
        $statement = $conn->prepare("UPDATE users SET imgDescription = :description WHERE email = '$email'");
        $description = $this->getDescription();
        
        
        $statement->bindParam(":description", $description);

        $result = $statement->execute();

        return $result;
    }
    public function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    
    function protectAgainstBruteForceAttacks($account = null, $clear = false)
    {
        $conn = Db::getConnection();
    // protect your website against brute_force_attacks
    // call protect_against_brute_force_attacks() to log
    // call protect_against_brute_force_attacks(true) to remove logs with current IP-adress
    
    // Configurate the script here
    $config['table_name'] = 'antibruteforcetable'; // make sure its not used for something else
    $config['attempts'] = 5; // count the amounts of (failed) attempts
    $config['in_amount_of_minutes'] = 3; // check last ... minutes
    $config['get_account'] = $_POST['email']; // what is the account-input? Emailadress? IP
    
    $config['could_not_create_table'] = 'The anti-brute-force-table can\'t be made.'; // error messages
    $config['could_not_clear_rows'] = 'The rows with your IP couldn\'t be deleted'; // error messages
    $config['could_not_select_logs'] ='Can\'t SELECT the logs for some reason.'; // error messages
    $config['user_is_bruteforcing'] = 'You seems like a brute-forcer. Just wait a few minutes before trying again.'; // error messages
    $config['could_not_update_table'] = 'The log can\'t be made.'; // error message
    
    // grap some information
    $ipadress = self::getUserIpAddr();
  /*  if($account !== NULL)
        {
        $account = $_POST[$config['account']];
        }
    */
    // make table in database (connection needed)
    $stmt = $conn->prepare("
                    CREATE TABLE IF NOT EXISTS ".$config['table_name']."
                        (
                        abf_id int(11) NOT NULL auto_increment,
                        abf_account varchar(255) NOT NULL,
                        abf_ipadress varchar(15) NOT NULL,
                        abf_time datetime NOT NULL,
                        abf_post text NOT NULL,
                        abf_get text NOT NULL,
                        PRIMARY KEY  (abf_id)
                        )
                    ENGINE='MyISAM'
                    DEFAULT CHARSET='utf8'
                    COMMENT='Logs of brute-force attacks' ;
                    AUTO_INCREMENT = 1;
                    ");
    $res = $stmt->execute();
    // check for table
    if ($res === false)
        {
        trigger_error($config['could_not_create_table']);
        return false;
        }
    
    // check if login was good
    if($clear !== false)
        {
        // clear the records for this ip for this account
        $stmt = $conn->prepare("DELETE FROM ".$config['table_name']." WHERE abf_ipadress = '".$ipadress."' AND abf_account = '".$account."' ");
        $res = $stmt->execute();
        if ($res === false)
            {
            trigger_error($config['could_not_clear_rows']);
            return false;
            }    
        }
      
    // search in database for records on this adress, only last $config['minutes']
    $stmt = $conn->prepare("SELECT COUNT(abf_id) FROM ".$config['table_name']." WHERE abf_ipadress = '".$ipadress."' AND abf_time > DATE_SUB(NOW(), INTERVAL ".$config['in_amount_of_minutes']." MINUTE)");
    $res = $stmt->execute();
    // could we get the requested data?
    if ($res === false)
        {
        trigger_error($config['could_not_select_logs']);
        return false;
        }
    // yes, we can. So, check for brute-force attempts
    else
        {
        // fetch it while you can
        $data = $stmt->fetch(PDO::FETCH_NUM);
        var_dump($data);
        // oke, here is the master-part: the equasion
        if($data[0] > $config['attempts'])
            {
            // to much login-attempts in the configured time
            // let de server sleep (and let the user wait)
            sleep(5);
            die($config['user_is_bruteforcing']);
            return false;
            }
        
        // make a log of this attempt
        $stmt = $conn->prepare("INSERT INTO ".$config['table_name']." (abf_account, abf_ipadress, abf_time, abf_get, abf_post) VALUES ('".$account."', '".$ipadress."', NOW(), '".print_r($_GET, true)."', '".print_r($_POST, true)."'); ");
        $res = $stmt->execute();
        // could it be done?
        if ($res === false)
            {
            // trigger the error
            trigger_error($config['could_not_update_table']);
            return false;
            }
        }
    return true; // why not?
    }

}


/*
public static function getAll(){
    $conn = DB::getConnection();

    $statement = $conn->prepare("select * from users"); //$conn->query kan ook
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}*/

/**
 * Get the value of password
 */


?>



    



