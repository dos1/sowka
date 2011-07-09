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

if ((isset($_POST['comment'])) && (isset($_USER))) {
  mysql_query("INSERT INTO `comments` SET `aid`=".mysql_real_escape_string($comic['id']).", blog=0, uid=".mysql_real_escape_string($_USER['id']).
              ", content='".mysql_real_escape_string($_POST['comment'])."', date=NOW(), visible=1, deleted=0") or print mysql_error();
}

/*$comments = array(
              array(1, 'dos', 'http://dosowisko.net/', 168956789, 'Komci póki co ni ma.'),
              array(2, 'dosia', 'http://dosia.dosowisko.net/', 5456789678, 'Jak nie ma, jak są?'),
              array(3, 'Kasia Nałęcka', 'http://kasia.dosowisko.net/', 5456799678, 'Nekrofilka się znalazła, spójrz na datę!'),
              array(10, 'Bardzo baaardzo bardzo hmm ciekawe jak bardzo, bardzo ale to bardzo długi nick. O, taki długi!', 'http://dosowisko.net/', 168956789, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In odio augue, consectetur in posuere eget, tempor quis nisl. Aliquam quis odio nulla. Proin ultrices libero a dui feugiat faucibus. Morbi tempor nunc eget nulla mollis tristique. Quisque fringilla dignissim mollis. Aenean pretium bibendum aliquet. Morbi venenatis magna id nisi varius posuere gravida sapien imperdiet. Cras congue, urna hendrerit rutrum varius, ipsum justo consectetur ipsum, nec convallis mi diam id leo. Phasellus eget quam nunc. Donec pharetra viverra mauris, ut pretium enim porta a. Sed iaculis blandit odio.'),
              array(666, 'Ja', 'http://ja.dosowisko.net/', time(), 'To jest całkiem świeży komć.')
            );
*/
$page_comments="";
$q = mysql_query("SELECT comments.id as id, nickname, users.id as uid, link, date, content, users.admin FROM comments, users WHERE users.id=comments.uid AND aid=".
                  $comic['id']." AND visible=1 AND deleted=0 AND blog=0 ORDER BY id") or print mysql_error();

while ($comment = mysql_fetch_array($q)) {
  $user = get_user($comment[2]);
  $comment[3] = get_user_link($user);
  $comment[2] = get_user_avatar($user);
  $page_comments.=theme_comment($comment[0], htmlspecialchars($comment[1]), $comment[2], htmlspecialchars($comment[3]), $comment[4], htmlspecialchars($comment[5]), $comment[6]);
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

if (($comic['src']==$_CONFIG['comics_path'].'standzioba.png') && (isset($_GET['trele'])) && ($_GET['trele']=='morele')) {
  $comic['src']=$_CONFIG['comics_path'].'standzioba-full.png';
}

include_once('themes/'.$_CONFIG['theme'].'/comic.php');
