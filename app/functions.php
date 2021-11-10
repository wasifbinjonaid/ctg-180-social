<?php
    /**
     * Show alert message
     * 
     * @param string $msg  Pop message to user
     * @param string $type Type of messages to show
     * 
     * @return string message
     */
    function alert_message($msg, $type='danger')
    {
        return
        "<div class=\"alert alert-{$type} alert-dismissible fade show\" role=\"alert\">
            <strong>{$msg}!</strong>
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
            </button>
        </div>
        ";
    }

    /**
     * Validate legit email
     * 
     * @param string $email  email from user
     * 
     * @return bool true or false
     */
    function emailCheck($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    /**
     * Password Confirmation 
     * 
     * @param string $pass  first password from user
     * @param string $cpass second password from user
     * 
     * @return bool true or false
     */
    function passChcek($pass, $cpass)
    {
        if ($pass === $cpass) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    /**
     * Cell phone validation
     * 
     * @param string $cell  user cell number
     * 
     * @return bool true or false
     */
    function cellcheck($cell)
    {
        $length = strlen($cell);

        if (substr($cell, 0, 2) == '01' and $length > 10) {
            return true;
        } else if (substr($cell, 0, 4) == '8801' and $length > 12) {
            return  true;
        } else if (substr($cell, 0, 5) == '+8801' and $length > 13) {
            return true;
        } else {
            return  false;
        }
    }

    /**
     * encrypt data
     * @param string $data Any type of string data
     * 
     * @return string hashed password
     */
    function hashed($data)
    {
        return password_hash($data, PASSWORD_DEFAULT);
    }

    /**
     * upload file to server
     * 
     * @param string $file uploaded file
     * @param string $path server location to upload file
     * 
     * @return string $file_name;
     */
    function move($file, $path = '/')
    {

        $file_name = time() . '_' . rand() . '_' . $file['name'];
        $file_tmp = $file['tmp_name'];
        // $file_size = $file['size'];

        move_uploaded_file($file_tmp, $path . $file_name);

        return $file_name;
    }


    /**
     * Prints old form data
     * 
     * @param string $form_data input field data
     */
    function old($form_data)
    {
        if (isset($_POST[$form_data]))
        {
            echo $_POST[$form_data];
        }
        else
        {
            echo "";
        }
    }

    /**
     * Clear form data
     */
    function clean()
    {
        $_POST = '';
    }