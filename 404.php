<?
include_once('includes/functions.php');

$page_title='404';
$error['title']='404 Not Found';
$error['content']='<h3>Błąd 404 - Sówka nie istnieje</h3><p title="...a nawet medytował...">...to znaczy, nie znalazł strony. Choć szukał.</p>';

include_once('themes/'.$_CONFIG['theme'].'/error.php');
