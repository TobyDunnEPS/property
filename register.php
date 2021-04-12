<?php
	
	$name = "reg";
	include('config/db_connect.php');

	if(isset($_POST['submit'])){
	
			// escape sql chars
			$unm = mysqli_real_escape_string($conn, $_POST['username']);
			$em = mysqli_real_escape_string($conn, $_POST['email']);
			// $pwd = mysqli_real_escape_string($conn, $_POST['password']);
			$pwd = password_hash($password, PASSWORD_DEFAULT);
			
			
			// create sql
			$sql = "INSERT INTO login(username,email,password) VALUES('$unm','$em','$pwd')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: login.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

		}

	
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Sign Up</h4>
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<label>Username</label>
			<input type="text" name="username">
			
			<label>Your Email</label>
			<input type="text" name="email">
			
			<label>Password</label>
			<input type="password" name="password" >
			<div class="center">
			<div class="input-field col s12">
				<input type="submit" name="submit" value="Register" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>