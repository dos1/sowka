<?
include_once('includes/functions.php');

$error['title']='404 Not Found';
$error['content']='Błąd 404 - Sówka nie istnieje.';

include_once('themes/'.$_CONFIG['theme'].'/error.php');
