<?
include_once('includes/functions.php');

$page_title='Profil';

$profile['me']=false;

if (!isset($_GET['id']) || (!(is_numeric($_GET['id'])))) { if (isset($_USER)) { $_GET['id']=$_USER['id']; $profile['me']=true; } else { header('Location: '.$_CONFIG['siteurl'].'login/'); die(); } }

if (($profile['me']) && ($_POST)) {
  if (!(($_POST['name']) && ($_POST['surname']) && ($_POST['nickname']) && ($_POST['mail']))) {
    $profile['error']='Nie wypełniono wszystkich pól.';
  }
  else if (!validEmail($_POST['mail'])) {
    $profile['error']='Wprowadzono niepoprawny adres e-mail.';
  }
  else {
    mysql_query(sprintf("UPDATE users SET `name`='%s', `surname`='%s', `nickname`='%s', `mail`='%s', `link`='%s', `about`='%s' WHERE `id`=".$_USER['id'], mysql_real_escape_string($_POST['name']),
                mysql_real_escape_string($_POST['surname']), mysql_real_escape_string($_POST['nickname']), mysql_real_escape_string($_POST['mail']), mysql_real_escape_string($_POST['link']), mysql_real_escape_string($_POST['about']))) or print mysql_error();
    $profile['messages'][]='Zmiana danych w profilu zakończona pomyślnie.';
    if (($_POST['login']) && (($_POST['pass']) || ($_POST['pass2']))) {
      if (mysql_num_rows(mysql_query(sprintf("SELECT * FROM users WHERE login-active=1, login = '%s'", mysql_real_escape_string($_POST['login']))))>0) {
        $profile['error']='Podany login został już zajęty.';
      }
      else if (!validEmail($_POST['mail'])) {
        $profile['error']='Wprowadzono niepoprawny adres e-mail.';
      }
      else if ($_POST['pass']!=$_POST['pass2']) {
        $profile['error']='Wprowadzone hasła nie pasują do siebie.';
      }
      else {
        mysql_query("UPDATE users SET `login`='' WHERE `login`='".mysql_real_escape_string($_POST['login']));
        mysql_query("UPDATE users SET `login-active`=1, `login`='".mysql_real_escape_string($_POST['login'])."', `pass`='".
                    mysql_real_escape_string(hash('sha512','45Sówkalsk45adso238if:):D'.$_POST['pass'].'a\':LM:>').'d').
                    "' WHERE `id`=".$_USER['id']) or print mysql_error();
        $profile['messages'][]='Ustawienie nazwy użytkownika zakończone pomyślnie.';
      }
    }
    else if (($_POST['pass']) || ($_POST['pass2'])) {
      if ($_POST['pass']!=$_POST['pass2']) {
        $profile['error']='Wprowadzone hasła nie pasują do siebie.';
      }
      else if ($_USER['pass']!=hash('sha512','45Sówkalsk45adso238if:):D'.$_POST['oldpass'].'a\':LM:>').'d') {
        $profile['error']='Wprowadzone stare hasło jest nieprawidłowe.';
      }
      else {
        mysql_query("UPDATE users SET `pass`='".hash('sha512','45Sówkalsk45adso238if:):D'.$_POST['pass'].'a\':LM:>').'d'."' WHERE `id`=".$_USER['id']);
        $profile['messages'][]='Zmiana hasła zakończona pomyślnie.';
      }
    }
  }
}

$profile['title']='Profil użytkownika';

$user = mysql_fetch_assoc(mysql_query("SELECT users.*, COUNT(comments.id) as comment_count FROM users,comments WHERE comments.uid=users.id AND users.id=".$_GET['id']));

foreach ($user as $key => $val) {
  $profile[$key] = $val;
}

if (!$user) { include('404.php'); die(); }

$profile['avatar']=get_user_avatar($user);
$profile['fullname']=$user['name'].' '.$user['surname'];

$profile['services']['Facebook']=0;
$profile['services']['Konta Google']=0;
$profile['services']['OpenID']=0;

//if ($user['login-active']) $profile['services'][]='Sówka';
if (isset($user['facebook'])) $profile['services']['Facebook']=1;
if (isset($user['google'])) $profile['services']['Konta Google']=1;
if (isset($user['openid'])) $profile['services']['OpenID']=1;

include_once('themes/'.$_CONFIG['theme'].'/profile.php');
