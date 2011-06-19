<?
function theme_comment($id, $nick, $url, $date, $content) {
  return "<p>Komć nr $id od $nick ($url) wyslany $date<br/>$content</p>";
}
