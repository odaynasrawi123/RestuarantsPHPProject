<?php
  //RestuarantsDBManager and MealsDBManager are required in this page
  require_once("DatabaseManagers/RestuarantsDBManager.php");
  require_once("DatabaseManagers/MealsDBManager.php");
  $restuarantsDBManager = new RestuarantsDBManager();
  $mealsDBManager = new MealsDBManager();
?>

<!DOCTYPPE html>
<html>
    <head>
        <title>Restuarants</title>
        <!--=======Frontend main styling=========-->
        <link rel="stylesheet" type="text/css" href="css/main.css"></link>
    </head>
    <body>

        <!--=======main background=========-->
        <div class="background"></div>

        <!--=======header=========-->
        <header>
            <h1>Restaurants in israel</h1>
        </header>

        <!--=======main=========-->
        <main>
          <?php
            //Get all restuarants from database
            $restaurants = $restuarantsDBManager->getAllRestuarants($_SESSION['userId']);
            //fetch each row and create its html
            while ($row = $restaurants->fetch(PDO::FETCH_ASSOC))
            {
                echo '<section class="restuarant-section">';

                echo '<div class="section_header">';

                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>' . $row['city'] . '</p>';

                echo '</div>';

                echo '<div class="meals-content">';

                //Get all meals from the current restuarant
                $meals = $mealsDBManager->getRestuarantMeals($row['id']);
                //Fetch each meal then place its template inside the restuarant section
                while ($meal = $meals->fetch(PDO::FETCH_ASSOC)) include('Templates/meal_item.php');

                echo '</div>';

                echo '</section>';
            }
          ?>
        </main>

        <!--=======footer=========-->
        <footer>
            copy rights 2021
            <a href="Restuarant.php">backoffice</a>
        </footer>

    </body>
</html>