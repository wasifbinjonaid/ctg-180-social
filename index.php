<?php
	require_once('autoload.php');

	// login without password
	if (isset($_GET['rlc_now']))
	{
		$login_now = $_GET['rlc_now'];
		setcookie('login_user_cookie_id', $login_now, time() + 60*60*24);
		header('location:index.php');
	}

	// recent login feature
	if (isset($_GET['rlc_id']))
	{
		$rlc_id = $_GET['rlc_id'];

		$rl_arr = json_decode($_COOKIE['recent_login_id'], true);
		$rlu_arr = array_unique($rl_arr);

		$index = array_search($rlc_id, $rlu_arr);
		array_splice($rlu_arr, $index, 1);

		if (count($rlu_arr) > 0)
		{
			setcookie('recent_login_id', json_encode($rlu_arr), time() + 60*60*24);
		}
		else
		{
			setcookie('recent_login_id', '', time() - 60*60*24);
		}

		header('location:index.php');
	}

	// login view permission
	if (user_login())
	{
		header('location:profile.php');
	}

	if (isset($_COOKIE['login_user_cookie_id']))
	{
		$login_cookie_id = $_COOKIE['login_user_cookie_id'];
		$_SESSION['id'] = $login_cookie_id;
		header('location:profile.php');
	}

	// validation
	if(isset($_POST['submit']))
	{
		$user_email = $_POST['email'];
		$user_password = $_POST['password'];

		if(empty($user_email) or empty($user_password))
		{
			$msg = alert_message('All field required!');
		}
		else
		{
			if(authenticate($user_email) == false)
			{
				$msg = alert_message('This email does not exist');
			}
			else
			{
				$auth_user = authenticate($user_email);
				if (password_match($user_password, $auth_user->password))
				{
					// redirect to profile page
					$_SESSION['id'] = $auth_user->id;
					setcookie('login_user_cookie_id', $auth_user->id, time() + 60 * 60 * 7);
					header('location:profile.php');
				}
				else
				{
					$msg = alert_message('Incorrect Password!', 'warning');
				}
			}
		}
	}
?>
<?php include_once('templates/header.php'); ?>

    <div class="wrap shadow">
		<div class="card">
			<div class="card-body">
				<h2>Sign Up</h2>
				<?php if(isset($msg)) {echo $msg;} ?>
				<form action="" method="post">
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="email" value="<?php old('email'); ?>">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" class="form-control" type="password">
					</div>
					<div class="form-group">
						<input name="submit" class="btn btn-primary" type="submit" value="login">
					</div>
				</form>

				<hr>

				<a href="register.php">Create Account!</a>
			</div>
		</div>
	</div>

    <div class="wrap rlogin">
		<div class="row">
		<?php

			if (isset($_COOKIE['recent_login_id'])) :
				$recent_login_users = json_decode($_COOKIE['recent_login_id'], true);
				$users_id = implode(',', $recent_login_users);
				$sql = "SELECT * FROM users WHERE id IN ($users_id)";
				$data = connect()->query($sql);

				while($user = $data->fetch_object()) :
		?>
			<div class="col-md-4 mt-2 mb-2">
				<div class="card shadow">
					<div class="card-body box rlc-div">
						<a class="close rlc" href="?rlc_id=<?php echo $user->id; ?>">&times;</a>
						<a href="?rlc_now=<?php echo $user->id; ?>">
							<img src="assets/media/users/<?php echo $user->photo; ?>" alt="">
						</a>
						<h4 class="text-center"><?php echo $user->name; ?></h4>
					</div>
				</div>
			</div>
		<?php endwhile; 
		endif; ?>
		</div>
	</div>

<?php include_once('templates/footer.php'); ?>