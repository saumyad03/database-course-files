<?php
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $server_name = "localhost";
        $user_name = "root";
        $db_password = "";
        $db_name = "bank";   
        $connection = mysqli_connect($server_name, $user_name, $db_password, $db_name);
        if (!$connection) {
            die("Unsucesssful database connection" . mysqli_connect_error());
        }
        $sql = "SELECT Username, Password FROM LOGIN WHERE Username='$username' AND Password='$password'";
        $result = $connection->query($sql);
        $result->fetch_row();
        if ($result->num_rows === 0) {
            echo "This username and password combination is not valid.";
        } else {
            echo "Welcome, $username";
        }

    }
?>
<h1>Login</h1>
<form method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit">
</form>