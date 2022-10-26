<?php
require 'config.php';

if($_POST) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($_POST['username'] == '' || $_POST['email'] == '' || $_POST['password'] == '') {
        echo "<script>alert('Please Fill the blanked data!');</script>";
    } else {
        // query prepare
        $sql = "SELECT COUNT(email) AS num FROM users WHERE email=:email";
        $statement = $pdo->prepare($sql);
        // data bind
        $statement->bindValue('email', $email);
        // query execute
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

    if($row['num'] > 0) {
        echo "<script>alert('This email already exists!');</script>";
    } else {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        // insert into database
        $sql = "INSERT INTO users(username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('username', $username);
        $stmt->bindValue('email', $email);
        $stmt->bindValue('password', $hash_password);
        $result = $stmt->execute();
        if($result) {
            echo "Thanks for registration!".'<a href="login.php">Login</a>';
        }
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="register.php" method="post">
                    <div class="card my-5">
                        <div class="card-header bg-primary">
                            <h1 class="text-center text-white">Registration Form</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" value="Register Now" class="btn btn-primary">
                                <a href="login.php">Login Here!</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>