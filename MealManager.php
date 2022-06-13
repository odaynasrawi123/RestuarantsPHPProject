<?php
    //This code uses MealsDBManager
    require_once("DatabaseManagers/MealsDBManager.php");

    $mealsDBManager = new MealsDBManager();

    //Use session
    session_start();

    //Properties
    $name = "";
    $description = "";
    $price = "";
    $errors = array();

    //If mealId is set then update properties by meal data
    if(isset($_GET['mealId'])) {
        //Get meal
        $meal = $mealsDBManager->getMeal($_GET['mealId'])->fetch(PDO::FETCH_ASSOC);
        //Update meal properties
        $name = $meal["name"];
        $description = $meal["description"];
        $price = $meal["price"];
    }

    //==================Add Meal================
    //If addMeal is requested and mealId is not set then add meal
    if(isset($_POST['addMeal']) && !isset($_GET['mealId'])) {
        //Get post new properties
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        
        // ensure that form fields are filled properly
        if(empty($name)) array_push($errors,"Name is required");
        if(empty($description)) array_push($errors,"Description is required");
        if(empty($price)) array_push($errors,"Price is required");
        
        // if there are no errors, save user to database
        if(count($errors)==0) {
            //Add meal
            $isCreated = $mealsDBManager->addMeal($name, $description, $price, $_GET['restaurantId'], $_SESSION['userId']);
            
            //If is created (User owns restuarant)
            if($isCreated != -1) {
                //If there is an image file uploaded
                if(isset($_FILES['mealImage'])) {
                    $uploaddir = 'Meals/Images/';
                    $extention = pathinfo($_FILES['mealImage']['name'], PATHINFO_EXTENSION);
                    $uploadfile = $uploaddir . basename("Meal_" . $isCreated . ".jpg");
                    //Save image on server
                    move_uploaded_file($_FILES['mealImage']['tmp_name'], $uploadfile);
                }
    
                //Go back to meals page
                header('location: meals.php?restaurantId=' . $_GET['restaurantId']);
            }

            //In case meal not created then alert user for not owned restuarant
            array_push($errors,"You don't own the restaurant");
        }
    }

    //==================Edit Meal================
    //If editMeal is requested and mealId is set then edit meal
    if(isset($_POST['editMeal']) && isset($_GET['mealId'])) {
        //Get post new properties
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        
        // ensure that form fields are filled properly
        if(empty($name)) array_push($errors,"Name is required");
        if(empty($description)) array_push($errors,"Description is required");
        if(empty($price)) array_push($errors,"Price is required");
        
        // if there are no errors, save user to database
        if(count($errors)==0) {
            //Edit meal
            $isUpdated = $mealsDBManager->editMeal($_GET['mealId'], $name, $description, $price, $_SESSION['userId']);
            
            //If is updated (User owns restuarant)
            if($isUpdated) {
                //If there is an image file uploaded
                if(isset($_FILES['mealImage'])) {
                    $uploaddir = 'Meals/Images/';
                    $extention = pathinfo($_FILES['mealImage']['name'], PATHINFO_EXTENSION);
                    $uploadfile = $uploaddir . basename("Meal_" . $_GET['mealId'] . ".jpg");
                    //Save image on server
                    move_uploaded_file($_FILES['mealImage']['tmp_name'], $uploadfile);
                }
    
                //Go back to meals page
                header('location: meals.php?restaurantId=' . $_GET['restaurantId']);
            }

            //In case meal not created then alert user for not owned restuarant
            array_push($errors,"You don't own the restaurant");
        }
    }

    //If deleteMeal is requested then delete meal
    if(isset($_POST['deleteMeal'])) {
        //Delete meal
        $mealsDBManager->deleteMeal($_POST['mealId'], $_SESSION['userId']);
    }
?>