<?php
	session_start();
if ($_SESSION['client'] == null && $_SESSION['clientP'] == null) {
    header("Location:login.php");
	$_SESSION['rdrurl'] = $_SERVER['REQUEST_URI'];

}
$name = $_SESSION['client'];
	include('config/db_connect.php');

	$email = $title = $ptype = $city = '';
	$errors = array('email' => '', 'title' => '', 'ptype' => '', 'city' => '');

	if(isset($_POST['submit'])){
		
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
			// 	$errors['title'] = 'Title must be letters and spaces only';
			// }
		}
	

		// check city
		if(empty($_POST['city'])){
			$errors['city'] = 'City is required';
		} else{
			$city = $_POST['city'];
			// if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $city)){
			// 	$errors['city'] = 'city must be a comma separated list';
			// }
		}

		if(empty($_POST['ptype'])){
			$errors['ptype'] = 'Property Type is required';
		} else{
			$ptype = $_POST['ptype'];
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ptype = mysqli_real_escape_string($conn, $_POST['ptype']);
			$city = mysqli_real_escape_string($conn, $_POST['city']);

			// create sql
			$sql = "INSERT INTO properties(title,email,city,ptype) VALUES('$title','$email','$city','$ptype')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

		}

	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Property</h4>
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>

			<label>Property Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<label for="property_type">Choose a Property Type:</label>
			<select id="property_type" name="ptype">
				<option value="For Sale">For Sale</option>
				<option value="To Let">To Let</option>
			</select>

			<label>City</label>
			<input type="text" name="city" value="<?php echo htmlspecialchars($city) ?>">
			<div class="red-text"><?php echo $errors['city']; ?></div>
			<div class="center">
			<div class="input-field col s12">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>