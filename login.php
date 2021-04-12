<?php
    // MySQLi or PDO - connect to database
    $conn = mysqli_connect('127.0.0.1', 'root', 'dev', 'tutorial_property', '33062');
    $name ='log';
    $error="";
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $myusername = mysqli_real_escape_string($conn,$_POST['Username']);
        $mypassword = mysqli_real_escape_string($conn,$_POST['Password']);

        // $sql="SELECT id FROM login WHERE username = '$myusername' and password = '$mypassword' ";
        $sql="SELECT id FROM login WHERE username = '$myusername' ";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $count=mysqli_num_rows($result);
        

        if ($count == 1) {
            while($row=mysqli_fetch_assoc($result)) {
            if (password_verify($mypassword, $row['mypassword'])) {
                $login = true;
            }
        }
        
            session_start();
            $_SESSION["client"]= $myusername;
            $_SESSION["clientP"]= rand();
            //echo $_SESSION["client"];
            //echo $_SESSION["clientP"];
            // header("location:indexs.php");

            if(isset($_SESSION['rdrurl']))
            header('location: '.$_SESSION['rdrurl']);
            else
            header('location:index.php');
            
            //session_destroy();
        }
        else{
            echo '<script type="text/javascript">';
            echo "alert('Username or Password is Invalid')";
            echo "</script>";   
        }

    } 

    

?>


<!DOCTYPE html>
<html lang="en">


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

    <title>Login</title><br><br>
    <center><label>Identify Yourself</label></center>
    <form action="#" method="post">
    <label>Username</label>
    <input type="text" placeholder="Username" name="Username">
    <label>Password</label>
    <input type="password" placeholder="password" name="Password">
    <input type="submit" name="login" value="login" > 

    </form>
		
   
</html>

    
<?php include('templates/footer.php'); ?>