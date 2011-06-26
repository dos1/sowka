<?
function theme_comment($id, $nick, $url, $date, $content) {
  $komcie = "<div class=\"comment\">";
  $komcie .= "<div class=\"comment-user\"><a href=\"$url\"><img src=\"http://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/195648_1799748123_6359960_q.jpg\" /></a>";
  $komcie .= "<div class=\"comment-user-info\"><a href=\"$url\">$nick</a>";
  $komcie .= "<div>".date("d-m-Y", $date)."</div><div>".date("H:i:s",$date)."</div></div></div>";
  $komcie .= "<p>$content</p>";
  $komcie .= "</div>";
  return $komcie;
}
