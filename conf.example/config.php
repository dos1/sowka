<?
$_CONFIG['sitename']    = 'Sówka';
$_CONFIG['siteurl']     = 'http://localhost/';
$_CONFIG['theme']       = 'default';
$_CONFIG['comics_path'] = 'images/';

$_CONFIG['mysql_host']  = 'localhost';
$_CONFIG['mysql_user']  = 'user';
$_CONFIG['mysql_pass']  = 'password';
$_CONFIG['mysql_db']    = 'sowka';

$_CONFIG['fb']['admins'] = '179345567,100000123455';
$_CONFIG['fb']['appid']  = '1234567890';
$_CONFIG['fb']['secret'] = 'abcdef1234567890abcdef1234567890';
$_CONFIG['fb']['apikey'] = 'abcdef1234567890abcdef1234567890';

$_CONFIG['blip']['CONSUMER_KEY']    = 'abcdef1234567890ABCD';
$_CONFIG['blip']['CONSUMER_SECRET'] = 'abcdef1234567890abcedf1234567890ABCDEF12';
$_CONFIG['blip']['TOKEN_KEY']       = 'abcdef1234567890ABCD';
$_CONFIG['blip']['TOKEN_SECRET']    = 'abcdef1234567890abcdef1234567890ABCDEF12';

$_CONFIG['blip']['notify-user'] = 'sowi';
$_CONFIG['blip']['notify-msg']  = 'Nowy komć u Sówki!';

$_CONFIG['admin-sitename'] = 'Sowi patrol';
$_CONFIG['admin-siteurl'] = 'http://127.0.0.1/';

//$_CONFIG['GA-account'] = 'UA-123456789';

function show_ads() {
  return '<div id="ads"><a href="http://sowka.art.pl/">Sówka</a></div>';
}
