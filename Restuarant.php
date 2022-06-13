<?php
  //UserManager is required to verify that use own this restuarant
  include('ServerManagers/UserManager.php');
  //RestuarantsDBManager is required in this page
  require_once("DatabaseManagers/RestuarantsDBManager.php");
  $restuarantsDBManager = new RestuarantsDBManager();
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
      <div class="menu-item selected">
        <strong>Restaurants</strong>
      </div>
      <div class="menu-item red-item">
        <a href="Restuarant.php?logout='1'">logout</a>
      </div>
    </div>

    <!--=======Backoffice main content view layout behind side menu=========-->
    <div class="content-view">
      <div class="box">
        <h1>Restuarants</h1>

        <!--=======Restuarants table=========-->
        <table>
          <thead>
            <tr>
              <td>name</td>
              <td>city</td>
              <td></td>
            </tr>
          </thead>

          <tbody>

            <?php
              //Get all restuarants owned by user
              $restaurants = $restuarantsDBManager->getUserRestuarants($_SESSION['userId']);
              
              //If there is no restuarants yet then alert the user
              if($restaurants->rowCount() == 0) echo '<tr><td>Empty</td><td></td><td></td></tr>';
              else while ($row = $restaurants->fetch(PDO::FETCH_ASSOC))
              {
                //Fetch each restuarant and place its html row
                echo '<tr>';

                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td><a class="btn" href="meals.php?restaurantId='. $row['id'] .'">meals</a></td>';

                echo '</tr>';
              }
            ?>

          </tbody>
        </table>

        <!--=======Bottom bar=========-->
        <div class="btn_bar">
          <!--=======Add Restuarant button=========-->
          <a class="btn grey_clr" href="addRestaurant.php">Add Restuarant</a>
        </div>
      </div>
    </div>

  </body>
</html>