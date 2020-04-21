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

}
?>



    



