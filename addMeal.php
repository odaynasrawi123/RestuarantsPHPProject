<!--Meal manager is needed to handle adding/editing a meal-->
<?php include('ServerManagers/MealManager.php');?>

<!DOCTYPPE html>
<html>
    <head>
        <title>Restuarants - Backoffice</title>
        <!--=======Backoffice styling=========-->
        <link rel="stylesheet" type="text/css" href="css/style.css"></link>
    </head>
    <body>

        <!--=======Set proper title====-->
        <div class ="header">
            <?php if(isset($_GET['mealId'])): ?>
                <h2>Edit Meal</h2>
            <?php else: ?>
                <h2>Add Meal</h2>
            <?php endif; ?>
        </div>

        <form class="form_view" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <!--=======Display errors here=========-->
            <?php include('errors.php');?>

            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name;?>">
            </div>

            <div class="input-group">
                <label>Description</label>
                <input type="text" name="description" value="<?php echo $description;?>">
            </div>

            <div class="input-group">
                <label>price</label>
                <input type="number" name="price" value="<?php echo $price;?>">
            </div>

            <div class="input-group">
                <label>Image</label>
                <input type="file" name="mealImage" accept="image/*">
            </div>

            <!--=======Display button depending on functionality====
                =======(Add meal button / Edit meal button)=========-->
            <div class="input-group">
                <?php if(!isset($_GET['mealId'])): ?>
                    <Button type ="submit" name="addMeal" class="btn">Add</Button>
                <?php else: ?>
                    <Button type ="submit" name="editMeal" class="btn">Edit</Button>
                <?php endif; ?>
            </div>

        </form>

    </body>
</html>