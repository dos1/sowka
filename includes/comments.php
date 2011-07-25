<?
require 'blip/lib/blipapi.php';
require 'blip/lib/OAuth.php';

function comment_notify($comment) {
  global $_CONFIG;

  $oauth_consumer = new OAuthConsumer ($_CONFIG['blip']['CONSUMER_KEY'], $_CONFIG['blip']['CONSUMER_SECRET']);
  $oauth_token    = new OAuthToken ($_CONFIG['blip']['TOKEN_KEY'], $_CONFIG['blip']['TOKEN_SECRET']);

  $blipapi = new BlipApi ($oauth_consumer, $oauth_token);

  $b_update           = new BlipApi_PrivMsg ();

  $blog = '';
  if ($comment['blog']) $blog='blog/';
  $b_update->body     = $_CONFIG['blip']['notify-msg'].' '.$_CONFIG['siteurl'].$blog.$comment['aid'].'/#comment-'.$comment['id'];
  $b_update->user     = $_CONFIG['blip']['notify-user'];

  try {
    $response = $blipapi->create ($b_update);
  }
  catch (RuntimeException $e) {
    //printf ("Blip Error: [%d] %s\n\n%s", $e->getCode (), $e->getMessage (), $e->getTraceAsString ());
    return;
  }

  $b_update           = new BlipApi_PrivMsg ();

  $user = get_user($comment['uid']);
  $b_update->body     = $user['nickname'] . ': ';
  $len = 160-strlen($b_update->body);
  if (strlen($comment['content'])>$len) $comment['content']=substr($comment['content'],0,$len-3).'...';
  $b_update->body .= $comment['content'];
  $b_update->user     = $_CONFIG['blip']['notify-user'];

  try {
    $response = $blipapi->create ($b_update);
  }
  catch (RuntimeException $e) {
    //printf ("Blip Error: [%d] %s\n\n%s", $e->getCode (), $e->getMessage (), $e->getTraceAsString ());
    return;
  }

  /*if ($response['status_code'] == 201) {
    printf ("Utworzono status: %s\n", $response['headers']['location']);
  }
  else {
    printf ("Wrong status: [%d] %s\n", $response['status_code'], $response['status_body']);
  }*/

}
