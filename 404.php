<?
include('includes/functions.php');

$error['title']='404 Not Found';
$error['content']='Błąd 404 - Sówka nie istnieje.';

include('themes/'.$_CONFIG['theme'].'/error.php');
