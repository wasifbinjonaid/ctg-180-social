<?php
    require_once "autoload.php";

    if (user_login() == false)
	{
		header('location:index.php');
	}

    if (isset($_GET['user_id'])) {
		$login_user = show($_GET['user_id']);
	} else {
		$login_user = show($_SESSION['id']);
	}
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
        
        <h3 class="text-center display-4 py-1"><?php echo $login_user->username; ?></h3>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
						<td>Name</td>
						<td><?php echo $login_user->name; ?></td>
					</tr>
                    <tr>
						<td>Email</td>
						<td><?php echo $login_user->email; ?></td>
					</tr>
                    <tr>
						<td>Cell</td>
						<td><?php echo $login_user->cell; ?></td>
					</tr>
                    <tr>
						<td>Gender</td>
						<td><?php echo $login_user->gender; ?></td>
					</tr>
                </table>
            </div>
        </div>
    </section>

<?php include_once('templates/footer.php'); ?>