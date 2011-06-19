<?
include('includes/functions.php');

if (!isset($_GET['id']) || (!(is_numeric($_GET['id'])))) { $_GET['id']=1; }

$comic['id']=$_GET['id'];
$comic['name']='Name';
$comic['src']=$_CONFIG['comics_path'].'placeholder.png';
$comic['title']='Title text';
$comic['comment']='Some comment.';

include('themes/'.$_CONFIG['theme'].'/functions/comments.php');

$comments = array(
              array(1, 'dos', 'http://dosowisko.net/', 1, 'Komci póki co ni ma.'),
              array(2, 'dosia', 'http://dosia.dosowisko.net/', 5, 'Jak nie ma, jak są?')
            );

$page_comments="";
foreach ($comments as $comment) {
  $page_comments.=theme_comment($comment[0], $comment[1], $comment[2], $comment[3], $comment[4]);
}

include('themes/'.$_CONFIG['theme'].'/comic.php');
