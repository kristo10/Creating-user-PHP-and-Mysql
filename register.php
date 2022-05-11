<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <center>
        <h1>Register</h1>
        <form method="post" action="register.php">
            <table>
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name"></td>
                </tr>

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
                    <td><button type="submit" name="submit">Register</button></td>
                </tr>
            </table>
        </form>
    </center>
    <?php
    include 'db.php';
    if (isset($_POST['submit'])) {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo '<br><center><strong> Fill in the fields! </strong></center>';
        } else {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $created_at = time();
            $updated_at = time();

            $query = "INSERT INTO users1(name, email, password, created_at, updated_at) VALUES ('$name', '$email', '$password', NOW(), NOW())";
            $result = mysqli_query($con, $query);

            header('Location: login.php');
        }
    }
    ?>
</body>
</html>