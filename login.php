<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <center>
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <table>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email"></td>
                </tr>

                <tr>
                    <th>Password</th>
                    <td><input type="password" name="password"></td>
                </tr>

                <tr>
                    <td></td>
                    <td><button type="submit" name="submit"> Login </button></td>
                </tr>
            </table>
        </form>
    </center>

   <?php
   include 'db.php';
   if (isset($_POST['submit'])) {
       if (empty($_POST['email']) || empty($_POST['password'])) {
           echo '<br><center><strong> Fill in the fields! </strong></center>';
       } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "SELECT * FROM users1 WHERE email = '$email'";
            $result = mysqli_query($con, $query);

            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                while ($user = mysqli_fetch_assoc($result)) {
                    $dbpassword = $user['password'];
                    if (password_verify($password, $dbpassword)) {
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['user'] = $user;
                        header('Location: index.php');
                    } else {
                        echo '<br><center><strong> Error </center></strong>';
                    }
                }
            } else {
                echo '<br><center><strong> This account not exist';
            }
       }
   }

   ?>
</body>
</html>