<?
function theme_comment($id, $nick, $url, $date, $content) {
  setlocale(LC_ALL, 'pl_PL');
  $komcie = "<div class=\"comment write-comment-quest\">";
  $komcie .= "<div class=\"comment-user\"><a href=\"$url\"><img alt=\"Avatar użytkownika\" src=\"http://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/195648_1799748123_6359960_q.jpg\" /></a>";
  $komcie .= "<div class=\"comment-user-info\"><a href=\"$url\">$nick</a>";
  $komcie .= "<div>".strftime("%d %B %Y", $date)."</div><div>".date("H:i:s",$date)."</div></div></div>";
  $komcie .= "<p>$content</p>";
  $komcie .= "</div>";
  return $komcie;
}
function theme_write_comment_user() {
$form  = '<div id="write-comment" class="comment write-comment-user">';
$form .= '  <div class="comment-user"><div>Dodaj komentarz</div><div class="loggedas"><div>Zalogowany jako:</div><a>Marcin Błaszyk</a></div>';
$form .= '  <div class="comment-disclaimer">Prosimy o zachowanie kultury dyskusji. Komentarze nie służą do obrażania, ani reklamowania się.';
$form .= ' Wpisy niecenzuralne i obraźliwe będą natychmiast usuwane.</div>';
$form .= '  </div>';
$form .= '  <form method="POST">';
$form .= '    <textarea required="required" placeholder="Twój komentarz..."></textarea>';
$form .= '    <input type="submit" value="Wyślij" />';
$form .= '  </form>';
$form .= '</div>';
return $form;
}
function theme_write_comment_quest($return_url = '') {
$form = '<div id="write-comment" class="comment write-comment-guest">';
$form .= '  <div class="comment-user">Dodaj komentarz</div>';
$form .= '  <form method="POST">';
$form .= '    <textarea required="required" disabled="disabled" placeholder="Tylko zalogowani użytkownicy mogą dodawać komentarze. Zaloguj się za pomocą jednego z przycisków poniżej.">';
$form .= 'Tylko zalogowani użytkownicy mogą dodawać komentarze.'."\n";
$form .= 'Zaloguj się za pomocą jednego z przycisków poniżej.';
$form .= '</textarea>';
$form .= '  </form>';
$form .= '  <div class="login">Zaloguj się przy pomocy:</div>';
$form .= '  <p><a>Facebook</a> <a>Google Accounts</a> <a>OpenID</a> <a href="'.$return_url.'/login/">Sówka</a></p>';
$form .= '</div>';
return $form;
}
