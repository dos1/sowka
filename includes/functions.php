<?
require('conf/config.php');
session_set_cookie_params(0, '/', $_CONFIG['cookie_domain'], false, true);
session_start();

include('includes/validmail.php');

$baza = mysql_connect ($_CONFIG['mysql_host'], $_CONFIG['mysql_user'], $_CONFIG['mysql_pass']) or die('Nie można połączyć się z bazą danych ponieważ: ' . mysql_error());

mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8_polish_ci");

mysql_select_db ($_CONFIG['mysql_db']) or die(mysql_error());

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

//print "LOL: ".$_SESSION['user_id'];
if (isset($_SESSION['user_id'])) {
  $_USER = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user_id']));
}

if (!($fb_dontlogin==1)) {

$cookie = get_facebook_cookie($_CONFIG['fb']['appid'], $_CONFIG['fb']['secret']);

$facebook = new Facebook(array(
  'appId'  => $_CONFIG['fb']['appid'],
  'secret' => $_CONFIG['fb']['secret']
));

if (($cookie) && (!(isset($_USER)))) {
  try {
    $facebook->setAccessToken($cookie['access_token']);
    $me = $facebook->api('/me');

    mysql_query("INSERT IGNORE INTO `users`
    SET `facebook` = '".mysql_real_escape_string($me['id'])."',
    `name` = '".mysql_real_escape_string($me['first_name'])."',
    `surname` = '".mysql_real_escape_string($me['last_name'])."';");

    $_USER = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `facebook`='".mysql_real_escape_string($me['id'])."';"));

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

function get_user($id) {
  return mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE id=".$id));
}

function get_user_link($user) {
  global $_CONFIG;
  if (!$user['link']) return $_CONFIG['siteurl'].'profile/'.$user['id'].'/';
  else return $user['link'];
}

function get_user_avatar($_USER) {
  global $_CONFIG;
  if ($_USER['avatar']!='') {
    $_USER['avatar']='/images/avatars/'.$_USER['avatar'];
  }
  elseif ($_USER['facebook']!='') {
    $_USER['avatar']='http://graph.facebook.com/'.$_USER['facebook'].'/picture';
  }
  elseif ($_USER['mail']!='') {
    $_USER['avatar']='http://www.gravatar.com/avatar/'.md5(strtolower(trim($_USER['mail']))).'?rating=g&size=50&default='.urlencode($_CONFIG['siteurl'].'themes/'.$_CONFIG['theme'].'/images/avatar-default.png');
  }
  else {
    $_USER['avatar']='/themes/'.$_CONFIG['theme'].'/images/avatar-default.png';
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
?> <!--<script type="text/javascript" async="async" src="https://apis.google.com/js/plusone.js">
  {lang: 'pl'}
</script> -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<?
}

function getBrowser() 
 { 
     $u_agent = $_SERVER['HTTP_USER_AGENT']; 
     $bname = 'Unknown';
     $platform = 'Unknown';
     $version= "";

     //First get the platform?
     if (preg_match('/linux/i', $u_agent)) {
         $platform = 'linux';
     }
     elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
         $platform = 'mac';
     }
     elseif (preg_match('/windows|win32/i', $u_agent)) {
         $platform = 'windows';
     }
     
     // Next get the name of the useragent yes seperately and for good reason
     if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
     { 
         $bname = 'Internet Explorer'; 
         $ub = "MSIE"; 
     } 
     elseif(preg_match('/Firefox/i',$u_agent)) 
     { 
         $bname = 'Mozilla Firefox'; 
         $ub = "Firefox"; 
     } 
     elseif(preg_match('/Chrome/i',$u_agent)) 
     { 
         $bname = 'Google Chrome'; 
         $ub = "Chrome"; 
     } 
     elseif(preg_match('/Safari/i',$u_agent)) 
     { 
         $bname = 'Apple Safari'; 
         $ub = "Safari"; 
     } 
     elseif(preg_match('/Opera/i',$u_agent)) 
     { 
         $bname = 'Opera'; 
         $ub = "Opera"; 
     } 
     elseif(preg_match('/Netscape/i',$u_agent)) 
     { 
         $bname = 'Netscape'; 
         $ub = "Netscape"; 
     } 
     
     // finally get the correct version number
     $known = array('Version', $ub, 'other');
     $pattern = '#(?<browser>' . join('|', $known) .
     ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
     if (!preg_match_all($pattern, $u_agent, $matches)) {
         // we have no matching number just continue
     }
     
     // see how many we have
     $i = count($matches['browser']);
     if ($i != 1) {
         //we will have two since we are not using 'other' argument yet
         //see if version is before or after the name
         if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
             $version= $matches['version'][0];
         }
         else {
             $version= $matches['version'][1];
         }
     }
     else {
         $version= $matches['version'][0];
     }
     
     // check if we have a number
     if ($version==null || $version=="") {$version="?";}
     
     return array(
         'userAgent' => $u_agent,
         'name'      => $bname,
         'version'   => $version,
         'platform'  => $platform,
         'pattern'    => $pattern
     );
 }
