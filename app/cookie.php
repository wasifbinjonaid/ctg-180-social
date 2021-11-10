<?php

    /**
     * set alert message to cookie memory
     * 
     * @param string $key key in cookie memory
     * @param string $msg value against key
     * 
    */
    function set_cookie_message($key, $msg)
    {
        setcookie($key, $msg, time() + 2);
    }

    /**
     * get alert message from cookie memory
     * 
     * @param string $key key to look in cookie memory
     * 
    */
    function get_cookie_message($key)
    {
        if (isset($_COOKIE[$key]))
        {
            echo "<div class=\"alert alert-{$key} alert-dismissible fade show\" role=\"alert\">
            <strong>{$_COOKIE[$key]}!</strong>
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>
            ";
        }
    }