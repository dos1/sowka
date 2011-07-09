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

$id = mysql_fetch_array(mysql_query("SELECT * FROM actors WHERE id = ".$blog['author']." LIMIT 1"));
$blog['author'] = $id;

if ((isset($_POST['comment'])) && (isset($_USER))) {
  mysql_query("INSERT INTO `comments` SET `aid`=".mysql_real_escape_string($blog['id']).", blog=1, uid=".mysql_real_escape_string($_USER['id']).
              ", content='".mysql_real_escape_string($_POST['comment'])."', date=NOW(), visible=1, deleted=0") or print mysql_error();
}

include_once('themes/'.$_CONFIG['theme'].'/functions/comments.php');

$page_comments="";
$q = mysql_query("SELECT * FROM comments WHERE aid=".$blog['id']." AND visible=1 AND deleted=0 AND blog=1 ORDER BY id") or print mysql_error();

while ($comment = mysql_fetch_array($q)) {
  $user = get_user($comment['uid']);
  $page_comments .= theme_comment($comment,$user);
}

if (isset($_USER)) {
  $page_comments .= theme_write_comment_user();
}
else {
  $page_comments .= theme_write_comment_quest('/blog/'.$blog['id']);
}

$page_permalink = $_CONFIG['siteurl'].'blog/'.$blog['id'].'/';
$page_title = $blog['name'];

include_once('themes/'.$_CONFIG['theme'].'/blog.php');
