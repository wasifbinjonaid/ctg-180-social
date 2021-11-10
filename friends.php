<?php
    require_once('autoload.php');

    if (user_login() == false)
	{
		header('location:index.php');
	}

    $login_user = show($_SESSION['id']);
?>
<?php include_once('templates/header.php'); ?>

    <?php include_once('templates/menu.php'); ?>

    <section class="users">
        <div class="container">
            <div class="row">
            <?php
				
				$all_users = all('users');
				while ($user = $all_users->fetch_object()) :
                    if ($user->id != $_SESSION['id']) : ?>
                        <div class="col-md-3">
                            <div class="user-item">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <img src="assets/media/users/<?php echo $user->photo; ?>" alt="">
                                        <h4><?php echo $user->name; ?></h4>
                                        <a href="profile.php?user_id=<?php echo $user->id; ?>" class="btn btn-primary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
			    <?php endwhile; ?>
            </div>
        </div>
    </section>

<?php include_once('templates/footer.php'); ?>