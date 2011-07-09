<?
include_once('includes/functions.php');

$profile['me']=false;

if (!isset($_GET['id']) || (!(is_numeric($_GET['id'])))) { if (isset($_USER)) { $_GET['id']=$_USER['id']; $profile['me']=true; } else { header('Location: '.$_CONFIG['siteurl'].'login/'); die(); } }

$profile['title']='Profil użytkownika';

$user = mysql_fetch_assoc(mysql_query("SELECT users.*, COUNT(comments.id) as comment_count FROM users,comments WHERE comments.uid=users.id AND users.id=".$_GET['id']));

foreach ($user as $key => $val) {
  $profile[$key] = $val;
}

if (!$user) { include('404.php'); die(); }

$profile['avatar']=get_user_avatar($user);
//$profile['name']=$user['name'];
//$profile['surname']=$user['surname'];
$profile['fullname']=$user['name'].' '.$user['surname'];
//$profile['nickname']=$user['nickname'];
//$profile['email']=$user['email'];
//$profile['www']=$user['link'];
//$profile['mail']=$user['mail'];

$profile['services']['Facebook']=0;
$profile['services']['Konta Google']=0;
$profile['services']['OpenID']=0;

//if ($user['login-active']) $profile['services'][]='Sówka';
if (isset($user['facebook'])) $profile['services']['Facebook']=1;
if (isset($user['google'])) $profile['services']['Konta Google']=1;
if (isset($user['openid'])) $profile['services']['OpenID']=1;

include_once('themes/'.$_CONFIG['theme'].'/profile.php');
