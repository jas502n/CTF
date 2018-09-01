<?php
session_start();
include_once "lib/clean.php";
include_once "lib/database.php";
$action = $_GET['action'] ? $_GET['action'] : 'login';
switch ($action) {
    case 'login':
        login();
        break;
    case 'logout':
        unset($_SESSION['username']);
        unset($_SESSION['error']);
        redirect();
        break;
}

function login(){
    if (!isset($_POST['username']) || empty(trim($_POST['username']))) {
        $_SESSION['error'] = 'username cannot empty';
        redirect();
    }
    unset($_SESSION['error']);
        $username = addslashes($_POST['username']);
    $_SESSION['username'] = $username;
    redirect();
}

function redirect()
{
    header("location: index.php");
    exit();
}