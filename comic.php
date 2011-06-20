<?
include_once('includes/functions.php');

if (!isset($_GET['id']) || (!(is_numeric($_GET['id'])))) { $_GET['id']=-1; }

if ($_GET['id']>0) {
  $q = mysql_query("SELECT * FROM strips WHERE id=".$_GET['id']);
}
else {
  $q = mysql_query("SELECT * FROM strips ORDER BY id DESC LIMIT 1");
}

$comic = mysql_fetch_assoc($q);

if (!$comic) { include('404.php'); exit(); }

$comic['src']=$_CONFIG['comics_path'].$comic['src'];

$id = mysql_fetch_array(mysql_query("SELECT id FROM strips ORDER BY id ASC LIMIT 1"));
$comic['nav']['first'] = $id[0];
$id = mysql_fetch_array(mysql_query("SELECT id FROM strips WHERE id < ".$comic['id']." ORDER BY id DESC LIMIT 1"));
if (!$id[0]) $id[0]=$comic['nav']['first'];
$comic['nav']['prev']= $id[0];
$id = mysql_fetch_array(mysql_query("SELECT id FROM strips ORDER BY RAND() LIMIT 1"));
$comic['nav']['random'] = $id[0];
$id = mysql_fetch_array(mysql_query("SELECT id FROM strips WHERE id > ".$comic['id']." ORDER BY id ASC LIMIT 1"));
$comic['nav']['next'] = $id[0];

include('themes/'.$_CONFIG['theme'].'/functions/comments.php');

$comments = array(
              array(1, 'dos', 'http://dosowisko.net/', 168956789, 'Komci póki co ni ma.'),
              array(2, 'dosia', 'http://dosia.dosowisko.net/', 5456789678, 'Jak nie ma, jak są?'),
              array(3, 'Kasia Nałęcka', 'http://kasia.dosowisko.net/', 5456799678, 'Nekrofilka się znalazła, spójrz na datę!'),
              array(666, 'Ja', 'http://ja.dosowisko.net/', time(), 'To jest całkiem świeży komć.')
            );

$page_comments="";
foreach ($comments as $comment) {
  $page_comments.=theme_comment($comment[0], $comment[1], $comment[2], $comment[3], $comment[4]);
}

include('themes/'.$_CONFIG['theme'].'/comic.php');
