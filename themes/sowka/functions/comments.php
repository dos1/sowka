<?
function theme_comment($id, $nick, $avatar, $url, $date, $content, $admin=0) {
  setlocale(LC_ALL, 'pl_PL');
  if ($admin) { $admin='comment-user-admin'; $admintitle='title="Administrator"'; }
  $komcie = "<div class=\"comment write-comment-quest\">";
  $komcie .= "<div class=\"comment-user\"><a href=\"$url\"><img alt=\"Avatar\" src=\"".$avatar."\" /></a>";
  $komcie .= "<div class=\"comment-user-info $admin\"><a href=\"$url\" $admintitle>$nick</a>";
  $komcie .= "<div>".strftime("%d %B %Y", strtotime($date))."</div><div>".date("H:i:s",strtotime($date))."</div></div></div>";
  $komcie .= "<p>$content</p>";
  $komcie .= "</div>";
  return $komcie;
}
function theme_write_comment_user() {
global $_USER;
$form  = '<div id="write-comment" class="comment write-comment-user">';
$form .= '  <div class="comment-user"><div>Dodaj komentarz</div><div class="loggedas"><div>Zalogowany jako:</div><a href="'.$_USER['link'].'">'.$_USER['nickname'].'</a></div>';
$form .= '  <div class="comment-disclaimer">Prosimy o zachowanie kultury dyskusji. Komentarze nie służą do obrażania, ani reklamowania się.';
$form .= ' Wpisy niecenzuralne i obraźliwe będą natychmiast usuwane.</div>';
$form .= '  </div>';
$form .= '  <form method="POST" action="#write-comment">';
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
