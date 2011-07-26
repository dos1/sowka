<?
$fb_dontlogin = 1;

include_once('includes/functions.php');

if (!(isset($_USER))) {
  header('Location: '.$_CONFIG['siteurl']);
}

$page_title='Nowa usługa';

$login['error']='';

if (isset($_GET['mode'])) {
  if (($_GET['mode']=='google') || ($_GET['mode']=='openid')) {
    include_once 'includes/lightopenid/openid.php';
    try {
      $openid = new LightOpenID($_CONFIG['siteurl']);

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
             if (($_GET['mode']=='google') || (isset($_POST['openid']))) {
              header('Location: ' . $openid->authUrl()); die(); }
             else {
               $login['title']='Dodawanie usługi';
               include_once('themes/'.$_CONFIG['theme'].'/functions/login.php');
               $login['content']=theme_login_openid_form();
               include_once('themes/'.$_CONFIG['theme'].'/login.php');
               die();
             }
      } elseif($openid->mode == 'cancel') {
             // $_USER=1;
      } else {
if ($openid->validate()) {
//$_USER=1;
 $me=$openid->getAttributes();
 $me['id']=$openid->identity;

//print $me['namePerson'];
 if (!(isset($me['namePerson']))) $me['namePerson']=$me['namePerson/first'].' '.$me['namePerson/last'];
 if ((!(isset($me['namePerson/first'])) && (!(isset($me['namePerson/last']))))) {
    $me['namePerson/first']=$me['namePerson'];
 }
//print $me['namePerson'];
    mysql_query("UPDATE `users` SET `".$_GET['mode']."` = '".mysql_real_escape_string($me['id'])."' WHERE id=".$_USER['id'].";") or print mysql_error();
//print $openid->identity .'<br/>';
//print_r($openid->getAttributes());

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
    //print "WUT: ".$_USER['id'];

//        echo 'User ' . ($openid->validate() ? $openid->identity . ' has ' : 'has not ') . 'logged in.';
}
      }
    } catch(ErrorException $e) {
               $login['title']='Dodawanie usługi';
               include_once('themes/'.$_CONFIG['theme'].'/functions/login.php');
               $login['content']='<p class="error">'.htmlspecialchars($e->getMessage()).'</p>'.theme_login_openid_form();
               include_once('themes/'.$_CONFIG['theme'].'/login.php');
               die();
    }

  }
  elseif ($_GET['mode']=='facebook') {

$cookie = get_facebook_cookie($_CONFIG['fb']['appid'], $_CONFIG['fb']['secret']);

$facebook = new Facebook(array(
  'appId'  => $_CONFIG['fb']['appid'],
  'secret' => $_CONFIG['fb']['secret']
));

if ($cookie) {
  try {
    $facebook->setAccessToken($cookie['access_token']);
    $me = $facebook->api('/me');

    mysql_query("UPDATE `users` SET `".$_GET['mode']."` = '".mysql_real_escape_string($me['id'])."' WHERE id=".$_USER['id'].";") or print mysql_error();

    $_USER['logged_in_by_fb']=1;

    if (($_USER['link']=='') && (isset($me['link']))) {
      mysql_query("UPDATE `users` SET `link`='".mysql_real_escape_string($me['link'])."' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
      $_USER['link']=$me['link'];
    }

    if (($_USER['login']=='') && (isset($me['username']))) {
      mysql_query("UPDATE `users` SET `login`='".mysql_real_escape_string($me['username'])."' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
      $_USER['login']=$me['username'];
    }

    if (($_USER['login']=='') && (!(isset($me['username'])))) {
      mysql_query("UPDATE `users` SET `login`='".mysql_real_escape_string($me['name'])." ".mysql_real_escape_string($me['surname']).
                  "' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
      $_USER['login']=$me['name'].' '.$me['surname'];
    }

    if ($_USER['nickname']=='') {
      mysql_query("UPDATE `users` SET `nickname`='".mysql_real_escape_string($me['name'])." ".mysql_real_escape_string($me['surname']).
                  "' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
      $_USER['nickname']=$me['name'].' '.$me['surname'];
    }

    if (($_USER['mail']=='') && (isset($me['email']))) {
      mysql_query("UPDATE `users` SET `mail`='".mysql_real_escape_string($me['email'])."' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
      $_USER['mail']=$me['email'];
    }

  }
  catch (Exception $e) {
    //print $e->getMessage();
  }
}

  }
}

header('Location: '.$_CONFIG['siteurl'].'profile#services');
