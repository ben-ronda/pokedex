<?php
    require('db.php');

    $app->get("/register", function() use ($app) {
				return $app['twig']->render('registration.html.twig');
		});

    $app->post("/register", function() use ($app)
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = stripslashes($username);
            $username = mysql_real_escape_string($username);
            $email = stripslashes($email);
            $email = mysql_real_escape_string($email);
            $password = stripslashes($password);
            $password = mysql_real_escape_string($password);
            $new_user = new User($username, $password, $email, $id);
            $new_user->save();
            if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
            }
    return $app['twig']->render('registration.html.twig', array('types'=>Type::getAll(), 'pokemons'=>Pokemon::getALl()));
    });
    // If form submitted, insert values into the database.

    }else{
?>
function userExists($username, $password)
{
    $query = $GLOBAL['DB']->query("SELECT * FROM `users` WHERE username='$username';");
    $returned_users = $query->fetchAll(PDO::FETCH_ASSOC);
    $result = mysql_query($returned_users) or die(mysql_error());
    $rows = mysql_num_rows($result);
    if($rows==1){
    $_SESSION['username'] = $username;
    header("Location: index.php"); // Redirect user to index.php
    }else{
    echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
    }
    }else{
}
