<?
include_once('includes/functions.php');

$page_title='Logowanie';

if (isset($_GET['mode'])) {
  if (($_GET['mode']=='google') || ($_GET['mode']=='openid')) {
    include_once 'includes/lightopenid/openid.php';
    try {
      $openid = new LightOpenID;

      if(!($openid->mode)) {
              if ($_GET['mode']=='google') $openid->identity = 'https://www.google.com/accounts/o8/id';
              if (isset($_POST['openid'])) $openid->identity = $_POST['openid'];
     $openid->required = array(
      'namePerson',
      'namePerson/friendly',
      'web/default',
      'namePerson/first',
      'namePerson/last',
      'contact/email',
      'media/image/aspect11',
      'media/image/default'
    );
             if (($_GET['mode']=='google') || (isset($_POST['openid'])))
              header('Location: ' . $openid->authUrl());
             else {
               $login['title']='Logowanie';
               include_once('themes/'.$_CONFIG['theme'].'/functions/login.php');
               $login['content']=theme_login_openid_form();

               include_once('themes/'.$_CONFIG['theme'].'/login.php');
               die();
             }
      } elseif($openid->mode == 'cancel') {
              $_USER=1;
      } else {
if ($openid->validate()) {
//$_USER=1;
 $me=$openid->getAttributes();
 $me['id']=$openid->identity;

if (((!isset($me['namePerson'])) && (!isset($me['namePerson/friendly'])) && ((!isset($me['namePerson/first'])) || (!isset($me['namePerson/last'])))) 
       || (!isset($me['contact/email']))) {

    if( mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';"))==0) {


               $login['title']='Logowanie - błąd';
               include_once('themes/'.$_CONFIG['theme'].'/functions/login.php');
               $login['content']='<p>Serwer nie zwrócił wszystkich wymaganych do rejestracji danych.<br />Wymagane: adres e-mail oraz imię i nazwisko lub pseudonim.</p>';

               include_once('themes/'.$_CONFIG['theme'].'/login.php');
               die();
   }
}

//print $me['namePerson'];
 if (!(isset($me['namePerson']))) $me['namePerson']=$me['namePerson/first'].' '.$me['namePerson/last'];
 if ((!(isset($me['namePerson/first'])) && (!(isset($me['namePerson/last']))))) {
    $me['namePerson/first']=$me['namePerson'];
 }
//print $me['namePerson'];

    mysql_query("INSERT IGNORE INTO `users` SET `".$_GET['mode']."` = '".mysql_real_escape_string($me['id'])."',`name` = '".mysql_real_escape_string($me['namePerson/first'])."', `surname` = '".mysql_real_escape_string($me['namePerson/last'])."';") or print mysql_error();
//print $openid->identity .'<br/>';
//print_r($openid->getAttributes());

    $_USER = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';"));

    if ((!$_USER['link']) && (isset($me['web/default']))) {
      mysql_query("UPDATE `users` SET `link`='".mysql_real_escape_string($me['web/default'])."' WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';");
      $_USER['link']=$me['web/default'];
    }

    if ((!$_USER['login']) && (isset($me['namePerson/friendly']))) {
      mysql_query("UPDATE `users` SET `login`='".mysql_real_escape_string($me['namePerson/friendly'])."' WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';");
      $_USER['login']=$me['namePerson/friendly'];
    }

    if (!$_USER['login']) {
      mysql_query("UPDATE `users` SET `login`='".mysql_real_escape_string($me['namePerson']).
                  "' WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';");
      $_USER['login']=$me['namePerson'];
    }

    if ((!$_USER['nickname']) && (isset($me['namePerson/friendly']))) {
      mysql_query("UPDATE `users` SET `nickname`='".mysql_real_escape_string($me['namePerson/friendly']).
                  "' WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';");
      $_USER['nickname']=$me['namePerson/friendly'];
    }

    if (!$_USER['nickname']) {
      mysql_query("UPDATE `users` SET `nickname`='".mysql_real_escape_string($me['namePerson']).
                  "' WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';");
      $_USER['nickname']=$me['namePerson'];
    }

    if ((!$_USER['mail']) && (isset($me['contact/email']))) {
      mysql_query("UPDATE `users` SET `mail`='".mysql_real_escape_string($me['contact/email'])."' WHERE `".$_GET['mode']."`='".mysql_real_escape_string($me['id'])."';");
      $_USER['mail']=$me['contact/email'];
    }

    $_SESSION['user_id'] = $_USER['id'];
    //print "WUT: ".$_USER['id'];

//        echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
}
      }
    } catch(ErrorException $e) {
      echo $e->getMessage();
    }

  }
}

if (($_USER) && (isset($_GET['comic'])) ){
  header('Location: '.$_CONFIG['siteurl'].$_GET['comic'].'/#write-comment');
  die();
}
elseif (($_USER) && (isset($_GET['blog']))) {
  header('Location: '.$_CONFIG['siteurl'].'blog/'.$_GET['blog'].'/#write-comment');
  die();
}
elseif ($_USER) {
  header('Location: '.$_CONFIG['siteurl'].'profile.php');
  die();
}

$login['title']='Not implemented';
$login['content']='Logowanie nie istnieje.';

include_once('themes/'.$_CONFIG['theme'].'/login.php');
