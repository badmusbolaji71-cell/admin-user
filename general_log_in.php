<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pin lock out";
$connection = new mysqli($servername,$username,$password , $dbname);
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
if(empty($email) || empty($password)){
    echo "All must be filled";
}
$login = mysqli_query($connection,"SELECT*FROM admin_sign_up where email = '$email' AND password = '$password'");

$login_uem= mysqli_query($connection,"SELECT*FROM user where email = '$email' AND password = '$password'");

if(mysqli_num_rows($login) > 0 ){
    $_SESSION['email'] = $email;
    header("location:admin_dashboard.php");
    exit();
}
elseif( mysqli_num_rows($login_uem) > 0 ){
    $user = mysqli_fetch_assoc($login_uem);
    $id = (int)$user['id'];

    if ($user['login_status'] >= 3) {
        echo "Login limit reached. Contact the admin to reset your access.";
    } else {
        mysqli_query($connection, "UPDATE user SET login_status = login_status + 1 WHERE id = '$id'");
        $_SESSION["role"] = "user";
        $_SESSION["id"] = $id;
        $_SESSION['email'] = $email;
        header("location:homepage.php");
        exit();
    }

}
else{
    echo "No record found";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
        display:grid;
        justify-content:center;
        align-items:center;
}
#form{
       display:grid;
        justify-content:center;
        align-items:center;
        gap:40px;
         background-color: #0babf5;
         border:3px solid black;
         margin:10px;
         padding-top:20px;
         padding-bottom:20px;
         padding-right:20px;
         padding-left:20px;
         border-radius:20px;
}
input{
    height:35px;
    border-radius:15px;
 background-color: #444f92;
}

    </style>
</head>
<body>
    <center>Sign in</center>
    <form  method="post" id = "form">
        <label for="">Email:
            <input type="email" name="email" id="">
        </label>
        <label for="password">Password:
            <input type="password" name="password" id="">
        </label>
        <input type="submit" value="submit" name = "submit">
        
    </form>
</body>
</html>