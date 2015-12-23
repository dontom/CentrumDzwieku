<?php
session_start();

if (!isset($_SESSION['inicjuj']))
{
    session_regenerate_id();
    $_SESSION['inicjuj'] = true;
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}


if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
{
    die('Proba przejecia sesji udaremniona!');
}

if(!isset($_SESSION['user']))
{
    // Sesja się zaczyna, wiec inicjujemy użytkownika anonimowego
    $_SESSION['user'] = 0;
}
if($_SESSION['user'] === 0)
{
    header("Location: login.php");
}
?>