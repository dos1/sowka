<?
include('includes/functions.php');

if (!isset($_GET['id']) || (!(is_numeric($_GET['id'])))) { $_GET['id']=1; }

$blog['id']=$_GET['id'];
$blog['name']='Placeholder blognote';
$blog['date']=1;
$blog['content']='This is placeholder. Worth note.';

include('themes/'.$_CONFIG['theme'].'/functions/comments.php');

$comments = array(
              array(1, 'Pokemon', 'http://pokemon.dosowisko.net/', 1268986789, 'Fajna nocia, wejdz na mojego blogaska :*'),
            );

$page_comments="";
foreach ($comments as $comment) {
  $page_comments.=theme_comment($comment[0], $comment[1], $comment[2], $comment[3], $comment[4]);
}

include('themes/'.$_CONFIG['theme'].'/blog.php');
