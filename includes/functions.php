<?
require('conf/config.php');
$baza = mysql_connect ($_CONFIG['mysql_host'], $_CONFIG['mysql_user'], $_CONFIG['mysql_pass']) or die('Nie można połączyć się z bazą danych ponieważ: ' . mysql_error());

mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8_polish_ci");

mysql_select_db ($_CONFIG['mysql_db']);

include_once('includes/facebook/src/facebook.php');

function get_facebook_cookie($app_id, $app_secret) {
  $args = array();
  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  ksort($args);
  $payload = '';
  foreach ($args as $key => $value) {
    if ($key != 'sig') {
      $payload .= $key . '=' . $value;
    }
  }
  if (md5($payload . $app_secret) != $args['sig']) {
    return null;
  }
  return $args;
}

$cookie = get_facebook_cookie($_CONFIG['fb']['appid'], $_CONFIG['fb']['secret']);

$facebook = new Facebook(array(
  'appId'  => $_CONFIG['fb']['appid'],
  'secret' => $_CONFIG['fb']['secret']
));

if ($cookie) {
  try {
    $facebook->setAccessToken($cookie['access_token']);
    $me = $facebook->api('/me');

    mysql_query("INSERT IGNORE INTO `users`
    SET `facebook` = '".mysql_real_escape_string($me['id'])."',
    `name` = '".mysql_real_escape_string($me['first_name'])."',
    `surname` = '".mysql_real_escape_string($me['last_name'])."';");

    $_USER = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `facebook`='".mysql_real_escape_string($me['id'])."';"));

    if (($_USER['link']=='') && (isset($me['link']))) {
      mysql_query("UPDATE `users` SET `link`='".mysql_real_escape_string($me['link'])."' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
    }

    if (($_USER['login']=='') && (isset($me['username']))) {
      mysql_query("UPDATE `users` SET `login`='".mysql_real_escape_string($me['username'])."' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
    }

    if (($_USER['login']=='') && (!(isset($me['username'])))) {
      mysql_query("UPDATE `users` SET `login`='".mysql_real_escape_string($me['name'])." ".mysql_real_escape_string($me['surname'])."' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
    }

    if ($_USER['nickname']=='') {
      mysql_query("UPDATE `users` SET `nickname`='".mysql_real_escape_string($me['name'])." ".mysql_real_escape_string($me['surname'])."' WHERE `facebook`='".mysql_real_escape_string($me['id'])."';");
    }

  }
  catch (Exception $e) {
    //print $e->getMessage();
  }
}

function get_user($id) {
  return mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE id=".$id));
}

function get_user_avatar($_USER) {
  if ($_USER['avatar']!='') {
    $_USER['avatar']='/images/avatars/'.$_USER['avatar'];
  }
  elseif ($_USER['facebook']!='') {
    $_USER['avatar']='http://graph.facebook.com/'.$_USER['facebook'].'/picture';
  }
  return $_USER['avatar'];
}

function facebook_init() {
global $_CONFIG;
?>
<div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({appId: '<?= $_CONFIG['fb']['appid'] ?>', status: true, cookie: true,
                 xfbml: true});
      };
      (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/pl_PL/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
<? }

function twitter_init() {
?> <script type="text/javascript" async="async" src="http://platform.twitter.com/widgets.js"></script> <?
}

function buzz_init() {
?> <script type="text/javascript" async="async" src="http://www.google.com/buzz/api/button.js"></script> <?
}

function plusone_init() {
?> <script type="text/javascript" async="async" src="https://apis.google.com/js/plusone.js">
  {lang: 'pl'}
</script> <?
}
