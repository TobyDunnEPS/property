<?php
session_start();
if ($_SESSION['client'] == null && $_SESSION['clientP'] == null) {
    header("Location:login.php");
}
$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];


$name = $_SESSION['client'];
include('config/db_connect.php');

// write query for all properties
$sql = 'SELECT title, city, ptype, id FROM properties ORDER BY created_at';

// make query & get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$properties = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);

// (explode(',', $properties[0]['city']);

// print_r($properties);
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Properties</h4>
    <div class="container">
    <div class="row">
    <?php foreach($properties as $property) { ?>

        <div class="col s6 md3">
        <div class="card z-depth-0">
            <img src="img/home.svg" class="property">
        <div class="card-content center">
            <h6><?php echo htmlspecialchars($property['title']); ?></h6> 
            <ul>
            <h6><?php echo htmlspecialchars($property['ptype']); ?></h6> 
            <ul>
                <?php foreach(explode(',', $property['city'])as $prop){ ?>
                <li><?php echo htmlspecialchars($prop); ?> </li>
               <?php }  ?>
            </ul> 
        </div>
        <div class="card-action right-align">
            <a class="brand-text" href="details.php?id=<?php echo $property['id']?>">more info</a>
        </div>
        </div>
        </div>
    <?php } ?>

    </div>
    </div>
    <?php include('templates/footer.php'); ?>
</html>