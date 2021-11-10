<?php

require_once "autoload.php";

// chekc user login 
if (user_login() == false) {
    header('location:index.php');
}

$login_user = show($_SESSION['id']);


?>
<?php include_once('templates/header.php'); ?>

    <?php include_once('templates/menu.php'); ?>

    <section class="wrap user-profile">
        <?php

            if (isset($_POST['submit'])) {
            // get values 
                $old_pass = $_POST['old_password'];
                $new_pass = $_POST['new_password'];
                $c_pass = $_POST['confirm_new_password'];


                $hash_pass = hashed($new_pass);


                if (empty($old_pass) || empty($new_pass) || empty($c_pass)) {
                    echo $msg = alert_message('All fields are required ');
                } else if ($new_pass != $c_pass) {
                    echo  $msg = alert_message('Password confirmation failed ');
                } else if (password_verify($old_pass, $login_user->password) == false) {
                    echo $msg = alert_message('Old password not match');
                } else {
                    update("UPDATE users SET password='$hash_pass' WHERE id='$login_user->id'");
                    session_destroy();
                    header('location:index.php');
                }
            }

        ?>
        <div class="card shadow">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <input name="old_password" class="form-control" type="password" placeholder="Old Password">
                    </div>

                    <div class="form-group">
                        <input name="new_password" class="form-control" type="password" placeholder="New Password">
                    </div>

                    <div class="form-group">
                        <input name="confirm_new_password" class="form-control" type="password" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        <input name="submit" class="btn btn-primary" type="submit" value="Change Password">
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php include_once('templates/footer.php'); ?>