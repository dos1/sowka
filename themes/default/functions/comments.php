<?
function theme_comment($id, $nick, $url, $date, $content) {
  return "<div>$id. <a href=\"$url\">$nick</a> mówi: <div style=\"text-align: right; float: right\">".date("r", $date)."</div><p>$content</p></div>";
}
