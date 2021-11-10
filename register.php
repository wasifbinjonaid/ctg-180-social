<?php
	require_once('autoload.php');

	if (user_login())
	{
		header('location:profile.php');
	}

	if (isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $cell = $_POST['cell'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $gender = NULL;

        if(isset($_POST['gender']))
        {
            $gender = $_POST['gender'];
        }

        $hashed_password = hashed($password);

        if (empty($name) or empty($email) or empty($username) or empty($cell) 
            or empty($password) or empty($confirm_password) or empty('gender'))
        {
            $msg = alert_message('All fields require!');
        }
		else if (emailCheck($email) == false) 
		{
			$msg = alert_message('Invalid Email address');
		} 
		else if (cellcheck($cell) == false) 
		{
			$msg = alert_message('Invalid cell number');
		} 
		else if (passChcek($password, $confirm_password) == false) 
		{
			$msg = alert_message('Confirm password not match', 'warning');
		} 
		else if (dataCheck('users', 'email', $email) == false) 
		{
			$msg = alert_message('Email already exists', 'warning');
		} 
		else if (dataCheck('users', 'cell', $cell) == false) 
		{
			$msg = alert_message('Cell already exists', 'warning');
		} 
		else if (dataCheck('users', 'username', $uname) == false) 
		{
			$msg = alert_message('Username  already exists', 'warning');
		} 
        else
        {
            insert("INSERT INTO users (name, email, username, cell, password, gender)
                    VALUES ('$name', '$email', '$username', '$cell', '$hashed_password', '$gender')");
            $msg = alert_message('Success', 'success');
            clean();
        }
    }
?>

<?php include_once('templates/header.php'); ?>

    <div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Create Account Here</h2>
                <?php if(isset($msg)) {echo $msg;} ?>
				<form action="" method="post">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control form-control-sm" type="text"
                        value="">
					</div>

					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control form-control-sm" type="text"
                        value="">
					</div>
					
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control form-control-sm" type="text"
                        value="">
					</div>
					
					<div class="form-group">
						<label for="">Username</label>
						<input name="username" class="form-control form-control-sm" type="text"
                        value="">
					</div>
                    
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" class="form-control form-control-sm" type="password">
					</div>
                    
					<div class="form-group">
						<label for="">Confirm Password</label>
						<input name="confirm_password" class="form-control form-control-sm" type="password">
					</div>
                    
					<div class="form-group">
                        <label for="">gender</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="male">
                            <label class="custom-control-label" for="customRadioInline1">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="female">
                            <label class="custom-control-label" for="customRadioInline2">Female</label>
                        </div>
                    </div>
					
					<div class="form-group">
						<input name="submit" class="btn btn-primary" type="submit" value="Create">
					</div>
				</form>

				<hr>

				<a href="index.php">Login now!</a>
			</div>
		</div>
	</div>

<?php include_once('templates/footer.php'); ?>