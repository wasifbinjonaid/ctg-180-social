<?php

    include_once('autoload.php');

    if (user_login() == false)
    {
        header('location:index.php');
    }

    $login_user = show($_SESSION['id']);

?>
<?php include_once('templates/header.php'); ?>

    <?php include_once('templates/menu.php'); ?>

    <section class="wrap user-profile">
		<?php if (isset($login_user->photo)) : ?>
			<img  class="shadow" src="assets/media/users/<?php echo $login_user->photo; ?>" alt="">
		<?php elseif ($login_user->gender == 'male') : ?>
			<img width=50 height=50 class="shadow" src="assets/media/avatar/m.jpg" alt="">
		<?php elseif ($login_user->gender == 'female') : ?>
			<img style="margin:0 auto;" width=50 height=50 class="shadow" src="assets/media/avatar/f.jpg" alt="">
		<?php endif; ?>

		<?php 
		
			if(isset($_POST['submit']))
            {
				$user_id = $_SESSION['id'];
				if (empty($_FILES['photo']['name']))
				{
					header('location:photo.php');
					set_cookie_message('warning', 'Please select a photo');
				}
				else
				{
					$file = move($_FILES['photo'], 'assets/media/users/');
					update("UPDATE users SET photo='$file' WHERE id='$user_id'");
					header('location:photo.php');
					set_cookie_message('success', 'profile photo uploading');
				}
			}	
		
		?>
        <div class="card shadow mt-3">
			<div class="card-body">
				<?php get_cookie_message('warning'); ?>
				<?php get_cookie_message('success'); ?>
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="file" name="photo">
					<input type="submit" name="submit" value="Upload">
				</form>
			</div>
		</div>
    </section>

<?php include_once('templates/footer.php'); ?>