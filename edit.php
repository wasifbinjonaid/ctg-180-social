<?php

	require_once "autoload.php";

	// chekc user login 
	if (user_login() == false) 
	{
		header('location:index.php');
	}

	$login_user = show($_SESSION['id']);

?>
<?php include_once('templates/header.php'); ?>

    <?php include_once('templates/menu.php'); ?>

	<section class="user-profile">


<?php

if (isset($_POST['submit'])) {
	// get values 
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$cell = $_POST['cell'];
	$age = $_POST['age'];
	$education = $_POST['education'];
	$gender = $_POST['gender'];


	if (empty($name) || empty($email) || empty($username) || empty($cell) || empty($gender)) 
	{
		$msg = alert_message('All fields are required.');
	}
	else
	{
		update("UPDATE users SET name='$name', email='$email', username='$username', cell='$cell', gender='$gender', edu='$education', age='$age' WHERE id=$login_user->id");
		set_cookie_message('success','Update success message');
		header('location:edit.php');
	}
}

?>


<div class="card shadow">
	<div class="card-body">
	<?php if(isset($msg)) {echo $msg;} ?>
	<?php get_cookie_message('success'); ?>
		<form action="" method="POST">
			<div class="form-group">
				<label for="name">Name</label>
				<input name="name" class="form-control" type="text" value="<?php echo $login_user->name; ?>">
			</div>

			<div class="form-group">
				<label for="">Email</label>
				<input name="email" class="form-control" type="email" value="<?php echo $login_user->email; ?>">
			</div>

			<div class="form-group">
				<label for="">Username</label>
				<input name="username" class="form-control" type="text" value="<?php echo $login_user->username; ?>">
			</div>

			<div class="form-group">
				<label for="">Cell</label>
				<input name="cell" class="form-control" type="text" value="<?php echo $login_user->cell; ?>">
			</div>

			<div class="form-group">
				<label for="">Age</label>
				<input name="age" class="form-control" type="age" value="<?php echo $login_user->age; ?>">
			</div>

			<div class="form-group">
				<label for="">Education</label>
				<input name="education" class="form-control" type="text" value="<?php echo $login_user->edu; ?>">
			</div>

			<div class="form-group">
				<label for="">gender</label><br>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="male" <?php echo ($login_user->gender == 'male') ? "checked" : "" ?>>
					<label class="custom-control-label" for="customRadioInline1">Male</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="female"  <?php echo ($login_user->gender == 'female') ? "checked" : "" ?>>
					<label class="custom-control-label" for="customRadioInline2">Female</label>
				</div>
			</div>

			<div class="form-group">
				<input name="submit" class="btn btn-primary" type="submit" value="Save Changes">
			</div>
		</form>
	</div>
</div>
</section>

<?php include_once('templates/footer.php'); ?>