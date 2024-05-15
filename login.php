<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["Login"])){
            $email=$_POST["email"];
            $password=$_POST["password"];
            require_once "database.php";
            $sql="SELECT * FROM registration WHERE email=?";
            $params = array($email);
            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            header("Location:welcome.php");
           
        }
        ?>
        <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Enter Email:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter Password:">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Login" name="Login">
        </div>
        </form>
    </div>
</body>
</html>
