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
if (!$id) $id[0] = $comic['id'];
$comic['nav']['next'] = $id[0];

$q = mysql_query("SELECT actors.* FROM actors, actors_list WHERE actors_list.strip_id=".$comic['id']." AND actors.id=actors_list.actor_id ORDER BY actors.id;") or print mysql_error();
while ($row=mysql_fetch_assoc($q)) {
  $comic['actors'][]=$row;
}

include_once('themes/'.$_CONFIG['theme'].'/functions/comments.php');
include_once('includes/comments.php');

if ((isset($_POST['comment'])) && (isset($_USER))) {
  mysql_query("INSERT INTO `comments` SET `aid`=".mysql_real_escape_string($comic['id']).", blog=0, uid=".mysql_real_escape_string($_USER['id']).
              ", content='".mysql_real_escape_string($_POST['comment'])."', date=NOW(), visible=1, deleted=0") or print mysql_error();
  $id = mysql_insert_id();
  $q = mysql_query("SELECT * FROM comments WHERE id=".$id);
  comment_notify(mysql_fetch_assoc($q));
}

$page_comments="";
$q = mysql_query("SELECT * FROM comments WHERE aid=".$comic['id']." AND visible=1 AND deleted=0 AND blog=0 ORDER BY id") or print mysql_error();

while ($comment = mysql_fetch_array($q)) {
  $user = get_user($comment['uid']);
  $page_comments .= theme_comment($comment,$user,($id==$comment['id']));
}

if (isset($_USER)) {
  $page_comments .= theme_write_comment_user();
}
else {
  $page_comments .= theme_write_comment_quest('/'.$comic['id']);
}

$page_permalink = $_CONFIG['siteurl'].$comic['id'].'/';
$page_image = $_CONFIG['siteurl'].$comic['src'];
$page_title = $comic['name'];

include_once('themes/'.$_CONFIG['theme'].'/comic.php');
