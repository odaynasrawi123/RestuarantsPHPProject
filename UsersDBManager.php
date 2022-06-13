<?php 
  //Connection to database is required
  require_once("dbClass.php");

  //This class uses database connection
  class UsersDBManager extends dbClass {
    
    //Check if user exists by email
    public function userExists($email){
      //Create connection to database
      $this->connect();

      //Query
      $user_check_query="SELECT count(*) FROM users WHERE email = '$email'";

      //Execute query
      $result=$this->connection->query($user_check_query);

      //Get number of columns in result
      $count=$result->fetchColumn();

      //Disconnect from database
      $this->disconnect();

      //Return whether user exist or not
      return $count > 0;
    }

    //Register user
    public function registerUser($username, $email, $password) {
      //Create connection to database
      $this->connect();
      //Encrypt password by MD5 hash encryption
      $encPass = md5($password);
      //Insert query
      $reg_query = "INSERT INTO users (username, email, password)
        VALUES ('$username','$email','$encPass')";
      //Execute query
      $query = $this->connection->query($reg_query);
      //Get number of affected rows
      $affectedRows = $query->rowCount();
      //Disconnect from database
      $this->disconnect();
      //Return whether user is added or not
      return $affectedRows > 0;
    }

    //Returns user data by email and password
    public function loginUser($email, $password) {
      //Create connection to database
      $this->connect();
      //Encrypt password by MD5 hash encryption
      $encPass = md5($password);
      //Query
      $query = "SELECT * FROM users WHERE email='$email' AND password='$encPass'";
      //Execute query
      $result = $this->connection->query($query);
      //Disconnect from database
      $this->disconnect();
      //Return user data row
      return $result->fetch();
    }
  
  }
?>