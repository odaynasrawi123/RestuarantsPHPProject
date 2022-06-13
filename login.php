<!--=======UserManager is required to handle login=====-->
<?php include('ServerManagers/UserManager.php');?>

<!DOCTYPPE html>
<html>
    <head>
        <title>Restuarants - Backoffice</title>
        <!--=======Backoffice styling=========-->
        <link rel="stylesheet"  href="css/style.css">
    </head>
    <body>

        <div class="header">
            <h2>login</h2>
        </div>

        <!--=======Login form=========-->
        <form class="form_view" method="post" action="login.php">

            <!--=======Display errors here=========-->
            <?php include('errors.php');?>

            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>

            <div class="input-group">
                <Button type ="submit" name="login" class="btn">Login</Button>
            </div>

            <!--=======Register button=========-->
            <p>
                not yet a member ? <a href="register.php">Sign Up</a>
            </p>

        </form>

    </body>
</html>