<?
require('conf/config.php');
$baza = mysql_connect ($_CONFIG['mysql_host'], $_CONFIG['mysql_user'], $_CONFIG['mysql_pass']) or die('Nie można połączyć się z bazą danych ponieważ: ' . mysql_error());

mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8_polish_ci");

mysql_select_db ($_CONFIG['mysql_db']);
