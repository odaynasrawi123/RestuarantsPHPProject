<?php
  //Connection to database is required
  require_once("dbClass.php");

  //This class uses database connection
  class MealsDBManager extends dbClass {
    
    //Returns meals in restuarant by restuarant id
    public function getRestuarantMeals($restaurantId){
      //Create connection to database
      $this->connect();

      //Query
      $meals_query="Select m.id, m.name, m.price, m.description from meals m inner join restaurants r on m.RestaurantId = r.id where r.id = '$restaurantId'";

      //Execute query
      $result=$this->connection->query($meals_query);

      //Disconnect from database
      $this->disconnect();

      //Return result
      return $result;
    }

    //Get meal by id
    public function getMeal($mealId){
      //Create connection to database
      $this->connect();

      //Query
      $meal_query="Select name, price, description from meals where id = '$mealId'";

      //Execute query
      $result=$this->connection->query($meal_query);
      
      //Disconnect from database
      $this->disconnect();

      //Return result
      return $result;
    }

    //Add meal to restuarant
    public function addMeal($name, $description, $price, $restaurantId, $userId) {
      //Create connection to database
      $this->connect();
      //Query to check if user own restuarant
      $user_is_owner = "SELECT * FROM restaurants where userid = '$userId' and id = '$restaurantId';";
      //Checks if user own restuarant
      $isOwner = $this->connection->query($user_is_owner)->rowCount() > 0;
      //If owned then add meal
      if($isOwner) {
        //Add meal query
        $add_meal_query = "INSERT INTO meals (name, price, description, RestaurantId) VALUES ('$name', '$price', '$description', '$restaurantId');";
        //Execute insert query(Add meal)
        $query = $this->connection->prepare($add_meal_query)->execute();
        //Get added meal id
        $mealId = $this->connection->lastInsertId();
        //Disconnect from database
        $this->disconnect();
        //Return meal id
        return $mealId;
      }
      //Disconnect from database
      $this->disconnect();
      //If user don't own restuarant return -1
      return -1;
    }

    //Edit meal
    public function editMeal($mealId, $name, $description, $price, $userId) {
      //Create connection to database
      $this->connect();
      //Query to check if user own meal
      $user_is_owner = "SELECT * FROM meals m inner join restaurants r on m.RestaurantId = r.id where r.userid = '$userId' and m.id = '$mealId';";
      //Checks if user own restuarant
      $isOwner = $this->connection->query($user_is_owner)->rowCount() > 0;
      //If owned then edit meal
      if($isOwner) {
        $update_meal_query = "update meals set name='$name', price=" . $price . ", description='$description' where id = '$mealId';";
        //Execute meal update query (Update meal data)
        $query = $this->connection->prepare($update_meal_query)->execute();
        //Disconnect from database
        $this->disconnect();
        //Return true if execution was successfull and false otherwise
        return $query;
      }
      //Disconnect from database
      $this->disconnect();
      //If meal not owned by user return false
      return false;
    }

    //Delete meal
    public function deleteMeal($mealId, $userId) {
      //Create connection to database
      $this->connect();
      //Query to check if user own meal
      $user_is_owner = "SELECT * FROM meals m inner join restaurants r on m.RestaurantId = r.id where r.userid = '$userId' and m.id = '$mealId';";
      //Checks if user own restuarant
      $isOwner = $this->connection->query($user_is_owner)->rowCount() > 0;
      //If owned then delete meal
      if($isOwner) {
        //Delete meal query
        $delete_meal_query = "delete from meals where id = '$mealId';";
        //Execute delete meal query (Delete meal)
        $result = $this->connection->prepare($delete_meal_query)->execute();
        //Disconnect from database
        $this->disconnect();
        //Return true if execution was successfull and false otherwise
        return $result;
      }
      //Disconnect from database
      $this->disconnect();
      //If meal not owned by user return false
      return false;
    }
  
  }
?>