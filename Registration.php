<?php
require_once "database.php"; 

if(isset($_POST["submit"])){
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confirm_password=$_POST["confirm-password"];
    $errors=array();
    if(empty($firstname) or empty($lastname) or empty($email) or empty($password) or empty($confirm_password)){
        array_push($errors,"All Fields are required");
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Email is not valid");
    }
    if(strlen($password)<8){
        array_push($errors,"Password must be at least 8 characters long");
    }
    if($password !== $confirm_password){
        array_push($errors,"Password does not match");
    }
    if(count($errors)>0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }else{
        try {
            $sql ="INSERT INTO registration (firstname, lastname, email,password) VALUES (?, ?, ?, ?)";
            $stmt=sqlsrv_prepare($conn,$sql,array(&$firstname, &$lastname, &$email, &$password));
            if(sqlsrv_execute($stmt)){
               // echo "<div class='alert alert-success'>Successfully Registered</div>";
                header("Location: login.php");
                exit;
            }else{
                throw new Exception("Error in SQL statement execution");
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="firstname" placeholder="First Name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm-password" placeholder="Confirm Password">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php">If you are already registred please clik here to Login</a>
            </div>
        
    </form>
</div>
</body>
</html>
