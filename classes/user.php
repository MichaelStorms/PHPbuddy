<?php

include_once(__DIR__ . "/db.php");

class User
{
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $id;


    public function getId()
    {
        return $this->id;
    }

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
    public function save()
    {
        $conn = Db::getConnection();

        $statement = $conn->prepare("insert into users (firstname, lastname, email, password) values (:firstname, :lastname, :email, :password)");

        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $password = $this->getPassword();

        $statement->bindValue(":firstname", $firstname);
        $statement->bindValue(":lastname", $lastname);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);

        $result = $statement->execute();

        return $result;
    }
    
    public static function checkDouble($email)
    {
        $conn = DB::getConnection();

        $statement = $conn->prepare("SELECT * FROM users WHERE email='$email'"); //$conn->query kan ook
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
