<!--=======UserManager is required to handle registration=====-->
<?php include('ServerManagers/UserManager.php');?>

<!DOCTYPPE html>
<html>
    <head>
        <title>Restuarants - Backoffice</title>
        <!--=======Backoffice styling=========-->
        <link rel="stylesheet" type="text/css" href="css/style.css"></link>
    </head>
    <body>

        <div class ="header">
            <h2>Register</h2>
        </div>
        <!--===========Registration form===========-->
        <form class="form_view" method="post" action="register.php">
        
            <!--=======Display errors here=========-->
            <?php include('errors.php'); ?>

            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="username" value="<?php echo $username;?>">
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email;?>">
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1">
            </div>

            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="password_2">
            </div>

            <div class="input-group">
                <Button type ="submit" name="register" class="btn">Register</Button>
            </div>

            <!--=======Login button=========-->
            <p>
                Already a member? <a href="login.php">Sign in</a>
            </p>
        </form>

    </body>
</html>