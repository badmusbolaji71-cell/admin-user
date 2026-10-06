<?php
$name = $email = $confirm_password = $password =$passworderror=$fillall=$confirm_error="";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pin lock out";

$connection = new mysqli($servername,$username,$password , $dbname);

if(isset($_POST["submit"])){
    $isvalid = true;
    $email = $_POST["email"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirm_password  = $_POST["confirm_password"];
    if(empty($email) ||empty($name) || empty($password) || empty($confirm_password)){
        $fillall =  "All pages must be filled";
        $isvalid = false;
    }else{
        // $fillall = "Successfully"
    }
    if(empty($email)){
        $emailerror = "*input name ";
          $isvalid = false;
        
    }
    if(empty($password)){
        $passworderror = "Input password";
          $isvalid = false;
    }
    if(empty($confirm_password)){
        $confirm_error = "*confirm password";
          $isvalid = false;
    }
    elseif($confirm_password != $password){
        $confirm_error = "*Password do not match";
          $isvalid = false;
    }
            $select = mysqli_query($connection,"SELECT*FROM user where email = '$email'");
        if(mysqli_num_rows($select) > 0){
            echo "There is already an account with the email provided ";
            $isvalid =false;
        };
    if($isvalid){
        $insert = "INSERT into user(name,email,password) VALUES('$name','$email','$password')";
        $insert_query=mysqli_query($connection,$insert);
        if($insert){
            header("location:general_log_in.php");
        }

        
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
    <center>User Sign up</center>
    <form  method="post" id = "form">
        <label for="">Name:
            <input type="text" name="name" id="" value = "<?= $name ?>">
        </label>
        <label for="">Email:
        <input type="email" name="email" id="" placeholdetr = "Input Email" value = "<?= $email ?>">
        </label>
        <label for="">Password :
            <input type="password" name="password" id="" value = "<?= $password?>">
        </label>
        <label for="">Confirm_Password :
            <input type="password" name="confirm_password" id="" value = <?=$confirm_password?>>
        </label>
        
        <input type="submit" value="submit" name ="submit">
        <?php echo $fillall?>
        <p><a href="general_log_in.php">Sign in</a></p>
    </form>
</body>
</html>
