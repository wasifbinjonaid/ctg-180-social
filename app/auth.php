<?php

    /**
     * authenticate user email
     * 
     * @param string $email user email
     * 
     * @return bool|mysqli object result
     */
    function authenticate($email)
    {
        $auth_check = connect()->query("SELECT * FROM users WHERE email='$email'");

        if ($auth_check->num_rows == 1)
        {
            return $auth_check->fetch_object();
        }
        else
        {
            return false;
        }
    }

    /**
     * login password check
     * 
     * @param string $password user password
     * @param string $db_password database password
     * @return bool true or false
    */
    function password_match($password, $db_password)
    {
        return (password_verify($password, $db_password)) ? true : false;
    }

    /**
     * check if user is logged in
     * 
     * @return bool true or false
    */
    function user_login()
    {
        return (isset($_SESSION['id'])) ? true : false;
    }