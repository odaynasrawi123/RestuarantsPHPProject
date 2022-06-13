<?php
  //Connection to database is required
  require_once("dbClass.php");

  //This class uses database connection
  class RestuarantsDBManager extends dbClass {
    
    //Returns all restuarants in database
    public function getAllRestuarants(){
      //Create connection to database
      $this->connect();

      $query = "Select id, name, city from restaurants";

      //Execute query
      $result = $this->connection->query($query);
      
      //Disconnect from database
      $this->disconnect();

      //Return result
      return $result;
    }

    //Get restuarants owned by user
    public function getUserRestuarants($userId){
      //Create connection to database
      $this->connect();

      $user_restuarants_query = "Select r.id, r.name, r.city from restaurants r inner join users u on u.id = r.userId where u.id = '$userId'";

      //Eexecute query
      $result = $this->connection->query($user_restuarants_query);
      
      //Disconnect from database
      $this->disconnect();

      //Return result
      return $result;
    }

    //Add restuarant
    public function addRestaurant($name, $city, $userId) {
      //Create connection to database
      $this->connect();
      //Add restuarant query
      $insert_query = "INSERT INTO restaurants (name, city, userId) VALUES ('$name', '$city', '$userId')";
      //Execute query
      $query = $this->connection->query($insert_query);
      //Get affected rows
      $affectedRows = $query->rowCount();
      //Disconnect from database
      $this->disconnect();
      //Return whether restuarant is added
      return $affectedRows > 0;
    }
  
  }
?>