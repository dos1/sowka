<?
function theme_archive($comic) {
  return '<a href="/'.$comic['id'].'">'.$comic['name'].'</a><br/>';
}
