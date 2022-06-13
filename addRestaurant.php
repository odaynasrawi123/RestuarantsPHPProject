<!--=========RestaurantManager is needed to handle adding a restuarant====-->
<?php include('ServerManagers/RestaurantManager.php');?>

<!DOCTYPPE html>
<html>
    <head>
        <title>Restuarants - Backoffice</title>
        <!--=======Backoffice styling=========-->
        <link rel="stylesheet" type="text/css" href="css/style.css"></link>
    </head>
    <body>

        <div class="header">
            <h2>Add Restaurant</h2>
        </div>

        <form class="form_view" method="post" action="addRestaurant.php">
            <!--=======Display errors here=========-->
            <?php include('errors.php');?>

            <div class="input-group">
                <label>Restaurant Name</label>
                <input type="text" name="resName" value="<?php echo $resName;?>">
            </div>

            <div class="input-group">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $city;?>">
            </div>

            <div class="input-group">
                <Button type ="submit" name="addRestaurant" class="btn">Add</Button>
            </div>

        </form>

    </body>
</html>