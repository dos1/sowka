<?
session_start();
unset($_SESSION['user_id']);
include('conf/config.php');
header('Location: '.$_CONFIG['siteurl']);

