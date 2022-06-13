<?php
    require_once("DatabaseManagers/RestuarantsDBManager.php");

    $restuarantsDBManager = new RestuarantsDBManager();

    session_start();
    $resName = "";
    $city = "";
    $errors = array();

    //==================Add Restaurant================
    //If addRestaurant is requested then add Restuarant
    if(isset($_POST['addRestaurant'])) {
        //Get post new properties
        $resName = $_POST['resName'];
        $city = $_POST['city'];
        
        // ensure that form fields are filled properly
        if(empty($resName)) array_push($errors,"Restuarant Name is required");
        if(empty($city)) array_push($errors,"City is required");
        
        // if there are no errors, save user to database
        if(count($errors)==0) {
            //Add Restaurant
            $isCreated = $restuarantsDBManager->addRestaurant($resName, $city, $_SESSION['userId']);
            //Go back to Restuarants
            header('location: Restuarant.php');
        }
    }
?>