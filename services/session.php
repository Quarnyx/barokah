<?php
// Initialize the session
require_once('./services/database.php');

session_start();

function checkAuth($email)
{
    if (DatabaseService::getInstance()->checkUser($email)) {
        setSesstion();
        return true;
    } else {
        return "Email is not valid";
    }
}

function setSesstion()
{
    $_SESSION["default_user"] = true;
}

function logoutSesstion()
{
    $_SESSION["default_user"] = false;
}

