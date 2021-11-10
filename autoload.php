<?php

    session_start();

    // Loading all system files
    include_once('config.php');
    include_once('app/session.php');
    include_once('app/cookie.php');
    include_once('app/auth.php');
    include_once('app/database.php');
    include_once('app/functions.php');