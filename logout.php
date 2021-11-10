<?php
    
    session_start();
    $logout_user_id = $_SESSION['id'];

    if (isset($_COOKIE['recent_login_id']))
    {
        $old_data = json_decode($_COOKIE['recent_login_id'], true);
        array_push($old_data, $logout_user_id);

        setcookie('recent_login_id', json_encode($old_data), time() + 60 * 60 * 24 * 365);
    }
    else
    {
        $arr = [];
        array_push($arr, $logout_user_id);
        setcookie('recent_login_id', json_encode($arr), time() + 60 * 60 * 24 * 365);
    }


    session_destroy();
    setcookie('login_user_cookie_id', $auth_user->id, time() - 60 * 60 * 7);
    header('location:index.php');
?>