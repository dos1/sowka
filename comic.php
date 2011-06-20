<?
include('includes/functions.php');

if (!isset($_GET['id']) || (!(is_numeric($_GET['id'])))) { $_GET['id']=1; }

$comic['id']=$_GET['id'];
$comic['name']='Placeholder strip';
$comic['src']=$_CONFIG['comics_path'].'placeholder.png';
$comic['date']=1;
$comic['title']='Title text';
$comic['comment']='This is placeholder. I like it.';
$comic['nav']['first'] = '1';
$comic['nav']['prev']  = '1';
$comic['nav']['random']= '1';
$comic['nav']['next']  = '1';
$comic['nav']['first'] = '1';

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
