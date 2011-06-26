<?
function theme_archive($comic) {
  return '<a href="/'.$comic['id'].'">'.$comic['name'].'</a><br/>';
}
function theme_archive_month ($date) {
  setlocale(LC_ALL, 'pl_PL');
  return '</div><div class="month"><h3>'.strftime('%B %Y',$date).'</h3>';
}
