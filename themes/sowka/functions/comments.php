<?
//function theme_comment($id, $nick, $avatar, $url, $date, $content, $admin=0) {
function theme_comment($comment, $user, $new_comment = 0) {
  setlocale(LC_ALL, 'pl_PL');
  $deleted = "<i>-usunięty-</i>";
  if (!$user) { $user['nickname']=$deleted; } else { $user['nickname']=htmlspecialchars($user['nickname']); }
  if ($user['admin']) { $admin='comment-user-admin'; $admintitle='title="Administrator"'; }
  if ($new_comment)
    $komcie = "<div class=\"comment write-comment-quest\" id=\"new-comment\">";
  else
    $komcie = "<div class=\"comment write-comment-quest\" id=\"comment-".$comment['id']."\">";
  $komcie .= "<div class=\"comment-user\">";
  if ($user['nickname']!=$deleted) $komcie .= "<a href=\"/profile/".$user['id']."/\">"; else $komcie .= "<a>";
  $komcie .= "<img alt=\"Avatar\" src=\"".htmlspecialchars(get_user_avatar($user))."\" />";
  $komcie .= "</a>";
  $komcie .= "<div class=\"comment-user-info $admin\">";
  if ($user['nickname']!=$deleted) $komcie .= "<a href=\"".htmlspecialchars(get_user_link($user))."\" $admintitle>"; else $komcie .= "<a>";
  $komcie .= $user['nickname'];
  $komcie .= "</a>";
  $komcie .= "<div>".strftime("%d %B %Y", strtotime($comment['date']))."</div><div>".date("H:i:s",strtotime($comment['date']))."</div></div></div>";
  $komcie .= "<p>".htmlspecialchars($comment['content'])."</p>";
  $komcie .= "</div>";
  return $komcie;
}
function theme_write_comment_user() {
global $_USER;
$form  = '<div id="write-comment" class="comment write-comment-user">';
$form .= '  <div class="comment-user"><div>Dodaj komentarz</div><div class="loggedas"><div>Zalogowany jako:</div><a href="/profile/">'.$_USER['nickname'].'</a></div>';
$form .= '  <div class="comment-disclaimer">Prosimy o zachowanie kultury dyskusji. Komentarze nie służą do obrażania, ani reklamowania się.';
$form .= ' Wpisy niecenzuralne i obraźliwe będą natychmiast usuwane.</div>';
$form .= '  </div>';
$form .= '  <form method="POST" action="#new-comment">';
$form .= '    <textarea name="comment" required="required" placeholder="Twój komentarz..."></textarea>';
$form .= '    <input type="submit" value="Wyślij" />';
$form .= '  </form>';
$form .= '</div>';
return $form;
}
function theme_write_comment_quest($return_url = '') {
$form = '<div id="write-comment" class="comment write-comment-guest">';
$form .= '  <div class="comment-user">Dodaj komentarz</div>';
$form .= '  <form>';
$form .= '    <textarea required="required" disabled="disabled" placeholder="Tylko zalogowani użytkownicy mogą dodawać komentarze. Zaloguj się za pomocą jednego z przycisków poniżej.">';
$form .= 'Tylko zalogowani użytkownicy mogą dodawać komentarze.'."\n";
$form .= 'Zaloguj się za pomocą jednego z przycisków poniżej.';
$form .= '</textarea>';
$form .= '  </form>';
$form .= '  <div class="login">Zaloguj się przy pomocy:</div>';
//$form .= '  <p><a>Facebook</a> <a>Google Accounts</a> <a>OpenID</a> <a href="'.$return_url.'/login/">Sówka</a></p>';
$form .= ' <p><fb:login-button class="login-facebook" perms="email" onlogin="location.hash = \'write-comment\'; window.location.reload(true);">Facebook</fb:login-button>';
$form .= ' <a href="'.$return_url.'/login/google/" class="login-google">Konto Google</a>';
$form .= ' <a href="'.$return_url.'/login/openid/" class="login-openid">OpenID</a>';
$form .= ' <a href="'.$return_url.'/login/" class="login-sowka">Sówka</a>';
$form .= ' </p> ';
$form .= '</div>';
return $form;
}
