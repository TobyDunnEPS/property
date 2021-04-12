<?php
session_start();
if ($_SESSION['client'] == null && $_SESSION['clientP'] == null) {
    header("Location:login.php");
    $_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];

}
$name = $_SESSION['client'];
include('config/db_connect.php');

if(isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM properties WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        // success
        header('Location: index.php');
    } {
        // failure
        echo 'query error: ' . mysqli_error($conn);
    }
    }

// Check GET request id param
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make SQL
    $sql = "SELECT * FROM properties WHERE id= $id";

    // get the query results
    $result = mysqli_query($conn, $sql);

    // fetch result in array format

    $property = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);


}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container center grey-text">
    <?php if($property): ?>
        <h6>Property Title:</h6>
        <h4> <?php echo htmlspecialchars($property['title']); ?> </h4>
        
        <h6>Property Info:</h6>
        <h5><?php echo htmlspecialchars($property['city']); ?></h5>
        <h6>Property Type:</h6>
        <h5><?php echo htmlspecialchars($property['ptype']); ?></h5>
        <p>Created at: <?php htmlspecialchars($property['email']); ?> </p>

        <p><?php echo date($property['created_at']); ?> </p>

        <p>Updated at: <?php htmlspecialchars($property['email']); ?> </p>

        <p><?php echo date($property['updated_at']); ?> </p>

        <p>Edited By: <?php htmlspecialchars($property['email']); ?> </p>

        <p><?php echo date($property['edited_by']); ?> </p>


        <!-- EDIT FORM -->
        <a class="btn" href="edit.php?id=<?php echo $property['id']?>">Edit</a>
        <!--  DELETE FROM -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $property['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn red lighten-1">
            
        </form>

        <?php else: ?>
            <h5>No such Property exists!</h5>
            <?php endif; ?>
</div>
<?php include('templates/footer.php'); ?>

</html>