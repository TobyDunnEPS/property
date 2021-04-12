<?php
session_start();
if ($_SESSION['client'] == null && $_SESSION['clientP'] == null) {
    header("Location:login.php");
}
$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];



$name = $_SESSION['client'];
    include('config/db_connect.php');

    $r = mysqli_query($conn,"SELECT * FROM properties where ID = '".$_GET["id"]."'");
    $record = mysqli_fetch_assoc($r);

if (isset($_GET['sub'])) {
    $name=$_GET['title']; 
            $email=$_GET['email'];
            $city=$_GET['city'];
            $ptype=$_GET['property_type'];
            $up = mysqli_query($conn,"Update properties set title ='".$name."', city ='".$city."', email='".$email."', ptype='".$ptype."'  where id='".$_GET['id']."' ");
                }
            if (isset($up)) {
                 if ($up>=1) {
                header("Location:index.php");
            }             } 
              
            

    $email = $title = $city = '';
    $errors = array('email' => '', 'title' => '', 'city' => '', 'property_type' => '',);

    // if(isset($_POST['update'])){
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            // Get hidden input value
            $id = $_POST["id"];
            echo $id;
        
        // check email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required';
        } else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be a valid email address';
            }
        }

        // check title
        if(empty($_POST['title'])){
            $errors['title'] = 'A title is required';
        } else{
            $title = $_POST['title'];
            // if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            //  $errors['title'] = 'Title must be letters and spaces only';
            // }
        }

        // check city
        if(empty($_POST['city'])){
            $errors['city'] = 'City is required';
        } else{
            $city = $_POST['city'];
            // if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $city)){
            //  $errors['city'] = 'city must be a comma separated list';
            // }
        }

        if(empty($_POST['ptype'])){
            $errors['ptype'] = 'Property Type is required';
        } else{
            $ptype = $_POST['ptype'];

        }

        /*if(array_filter($errors)){
            //echo 'errors in form';
        } else {
            // save to db and check
            if(mysqli_query($conn, $sql)){
                // success
                header('Location: index.php');
            } else {
                echo 'query error: '. mysqli_error($conn);
            }

        }*/

    } // end POST check

	

?>

<!DOCTYPE html>
<html>
    
    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Edit a Property</h4>
        <form class="white" method="GET">
            <label>Your Email</label>
            <input type="text" name="email" value="<?php echo $record['email']; ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>Property Title</label>
            <input type="text" name="title" value="<?php echo $record['title']; ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label for="property_type">Choose a Property Type:</label>
            <select id="property_type" name="property_type">
                <?php if ($record['ptype']=="To Let") {
                    echo '<option value="For Sale" >For Sale</option>';
                    echo '<option value="To Let" selected>To Let</option>';
                } else {
                    echo '<option value="For Sale" selected>For Sale</option>';
                    echo '<option value="To Let" >To Let</option>';    
                }
                 
                 ?>
            </select>
            <label>City</label>
            <input type="text" name="city" value="<?php echo $record['city']; ?>">
            <div class="red-text"><?php echo $errors['city']; ?></div>
            <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
            <div class="center">
            <div class="input-field col s12">
                <input type="submit" name="sub" value="Update" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

</html>
