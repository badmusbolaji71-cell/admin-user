<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pin lock out";
$connection = new mysqli($servername,$username,$password , $dbname);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: #0babf5;
        }
               table{
            width:100%;
            border:1px solid black;
            border-collapse:collapse;
            justify-content:center;
            align-items:center;
            align-self:center;
            justify-self:center;
            background-color: #444f92;
            /* display:flex; */
            /* background-color:blue; */

        }
        tr,th,td{
             border:1px solid black;
            border-collapse:collapse;
        }
    </style>
</head>
<body>
    <center>
        <p>Dear <?php echo $_SESSION['email']?></p>
    <h1>Admin dashboard</h1>
  <table>
  <tr>
  <th>sn</th>
  <th>name</th>
  <th>email</th>
  <th>status</th>
  </tr>
  <?php
    
    $select ="SELECT * FROM user where login_status >=3";
    $select_query = mysqli_query($connection,$select);
    // $select = mysqli_query($connection,"SELECT * FROM user WHERE log_in_status >=3");
    $i = 1;
if(mysqli_num_rows($select_query) >0 ){
    
    while($row = mysqli_fetch_array($select_query)){
?>

    <tr>
    <td><?php echo $i++?></td>
    <td><?php echo $row["name"]?></td>
    <td><?php echo $row["email"]?></td>
    <td><?php echo $row["login_status"]?></td>
    <td><form  method="post">
        <input type="hidden" name="id" value = "<?php echo $row['id']?>">
        <button type="submit" name = "submit">Reset</button>
    </form></td>
    </tr>
    <?php
    }
}
       if(isset($_POST["submit"])){
          $id = $_POST["id"];
       $update =  "UPDATE user SET login_status = 0 WHERE id = '$id'";
       $update_query = mysqli_query($connection,$update);
    }
    ?>
    </table>
    </center>
</body>
</html> 