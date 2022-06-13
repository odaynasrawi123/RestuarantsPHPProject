<?php 
  //UserManager is required to verify if user own meals
  include('ServerManagers/UserManager.php');
  //MealManager is required in this page
  include('ServerManagers/MealManager.php');
	//if user is not logged in, they cannot access this page 
	if(empty($_SESSION['userId'])){
		header('location: login.php');
	}
?>

<!DOCTYPPE html>
<html>
  <head>
    <title>Restuarants - Backoffice</title>
    <!--=======Backoffice styling=========-->
    <link rel="stylesheet" type="text/css" href="css/style.css"></link>
  </head>
  <body>
  
    <!--=======Backoffice left side menu=========-->
    <div class="left-menu">
      <?php if(isset($_SESSION['username'])): ?>
        <div class="menu-item title">
          <p> welcome <Strong><?php echo $_SESSION['username'];?></strong></p>
        </div>
      <?php endif ?>
      <div class="menu-item">
        <a href="Restuarant.php">Restaurants</a>
      </div>
      <div class="menu-item red-item">
        <a href="meals.php?logout='1'">logout</a>
      </div>
    </div>

    <!--=======Backoffice main content view layout behind side menu=========-->
    <div class="content-view">
      <div class="box">
        <h1>Meals</h1>

        <!--=======Meals table=========-->
        <table>
          <thead>
            <tr>
              <td>name</td>
              <td>price</td>
              <td>Description</td>
              <td></td>
            </tr>
          </thead>

          <tbody>

            <?php
              //Get meals in restuarant
              $meals = $mealsDBManager->getRestuarantMeals($_GET['restaurantId']);

              //If there is no restuarants yet then alert the user
              if($meals->rowCount() == 0) echo '<tr><td>Empty</td><td></td><td></td><td></td></tr>';
              else while ($row = $meals->fetch(PDO::FETCH_ASSOC))
              {
                //Fetch each meal and place its template so it gets displayed
                include('Templates/backoffice/meal_item_tr.php');
              }
            ?>

          </tbody>
        </table>
        
        <!--=======Bottom bar=========-->
        <div class="btn_bar">
          <!--=======Add meal to restuarant button=========-->
          <a class="btn grey_clr" href="addMeal.php?restaurantId=<?php echo $_GET['restaurantId'] ?>">Add</a>
        </div>

      </div>
    </div>

  </body>
</html>