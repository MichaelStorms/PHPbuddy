<?php

include_once(__DIR__ . "/db.php");

 class Filter{

    protected $search;
    protected $locateS;
    protected $interestsS;
    protected $hobbyS;
    protected $extraS;



    
 

    public static function getUsers(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT id, Firstname , LastName , image , locatie , class FROM users");
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public static function getLocation($email){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT locatie FROM users WHERE email = '$email'");
        $statement->execute();
        $locatie = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $locatie;
    }

    public static function getInterests($email){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT interests FROM users WHERE email = '$email'");
        $statement->execute();
        $interests = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $interests;
    }
    public static function getHobby($email){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT hobby FROM users WHERE email = '$email'");
        $statement->execute();
        $hobby = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $hobby;
    }
    public static function getExtra($email){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT extra FROM users WHERE email = '$email'");
        $statement->execute();
        $extra = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $extra;
    }

    public static function getClass($email){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT class FROM users WHERE email = '$email'");
        $statement->execute();
        $extra = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $extra;
    }


    public static function searchPerson($search){
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE CONCAT_WS(' ', firstname, lastname) LIKE '%$search%'");
      //  $searchRes = $search;
      //  $statement->bindParam(":search",$searchRes);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function filterSearch($course,$locatie,$hobby,$extra){
        $conn = Db::getConnection();
        $query = "SELECT * FROM users WHERE ('$course' = '' OR interests = '$course') AND ('$locatie' = '' OR locatie = '$locatie') AND ('$hobby' = '' OR hobby = '$hobby') AND ('$extra' = '' OR extra= '$extra')";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Get the value of search
     */ 
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set the value of search
     *
     * @return  self
     */ 
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get the value of locateS
     */ 
    public function getLocateS()
    {
        return $this->locateS;
    }

    /**
     * Set the value of locateS
     *
     * @return  self
     */ 
    public function setLocateS($locateS)
    {
        $this->locateS = $locateS;

        return $this;
    }

    /**
     * Get the value of interestsS
     */ 
    public function getInterestsS()
    {
        return $this->interestsS;
    }

    /**
     * Set the value of interestsS
     *
     * @return  self
     */ 
    public function setInterestsS($interestsS)
    {
        $this->interestsS = $interestsS;

        return $this;
    }

    /**
     * Get the value of hobbyS
     */ 
    public function getHobbyS()
    {
        return $this->hobbyS;
    }

    /**
     * Set the value of hobbyS
     *
     * @return  self
     */ 
    public function setHobbyS($hobbyS)
    {
        $this->hobbyS = $hobbyS;

        return $this;
    }

    /**
     * Get the value of extraS
     */ 
    public function getExtraS()
    {
        return $this->extraS;
    }

    /**
     * Set the value of extraS
     *
     * @return  self
     */ 
    public function setExtraS($extraS)
    {
        $this->extraS = $extraS;

        return $this;
    }
 }