<?
include_once('includes/functions.php');

$q = mysql_query("SELECT * FROM strips ORDER BY id DESC");

include('themes/'.$_CONFIG['theme'].'/functions/archive.php');

$archive['title']="Archiwum";
$archive['content']='';

while ($row = mysql_fetch_assoc($q)) {
  $archive['content'].=theme_archive($row);
}

include('themes/'.$_CONFIG['theme'].'/archive.php');
