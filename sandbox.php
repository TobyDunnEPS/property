<?php
session_start();
if ($_SESSION['client'] == null && $_SESSION['clientP'] == null) {
    header("Location:login.php");
}
$name = $_SESSION['client'];
// ternary operators

// this is an example of normal if statement

// $score = 50;
// if($score > 40) {
//     echo 'high score!';
// } else {
//     echo 'low score';
// }

// // example of using same thing using ternary operator

// $val = $score > 40 ? 'High score!' : 'low score';
// echo $val;

// Super Global

// $_POST['name'], $_GET['name']

// echo $_SERVER['SERVER_NAME'] . '<br />';
// echo $_SERVER['REQUEST_METHOD'] . '<br />';
// echo $_SERVER['SCRIPT_FILENAME'] . '<br />';
// echo $_SERVER['PHP_SELF'] . '<br />';

// SESSIONS

if(isset($_POST['submit'])){
        // Cookie for gender
        setcookie('gender', $_POST['gender'], time() + 86400);
        
    session_start();
    
    $_SESSION['name'] = $_POST['name'];

    header('Location: index.php');
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tutorial</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="text" name="name">
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>