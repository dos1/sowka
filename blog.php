<?
include_once('includes/functions.php');

if (!isset($_GET['id']) || (!(is_numeric($_GET['id'])))) { $_GET['id']=-1; }

if ($_GET['id']>0) {
  $q = mysql_query("SELECT * FROM blog WHERE id=".$_GET['id']);
}
else {
  $q = mysql_query("SELECT * FROM blog ORDER BY id DESC LIMIT 1");
}

$blog = mysql_fetch_assoc($q);

if (!$blog) { include('404.php'); exit(); }

$id = mysql_fetch_array(mysql_query("SELECT * FROM blog WHERE id < ".$blog['id']." ORDER BY id DESC LIMIT 1"));
$blog['nav']['prev'] = $id;
$id = mysql_fetch_array(mysql_query("SELECT * FROM blog WHERE id > ".$blog['id']." ORDER BY id ASC LIMIT 1"));
$blog['nav']['next'] = $id;

include_once('themes/'.$_CONFIG['theme'].'/functions/comments.php');

$comments = array(
              array(1, 'Pokemon', 'http://pokemon.dosowisko.net/', 1268986789, 'Fajna nocia, wejdz na mojego blogaska :*'),
            );

$page_comments="";
foreach ($comments as $comment) {
  $page_comments.=theme_comment($comment[0], $comment[1], $comment[2], $comment[3], $comment[4]);
}

$page_comments .= theme_write_comment_quest('/blog/'.$blog['id']);

$page_permalink = $_CONFIG['siteurl'].'blog/'.$blog['id'].'/';
$page_title = $blog['name'];

include_once('themes/'.$_CONFIG['theme'].'/blog.php');
