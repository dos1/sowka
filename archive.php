<?
include_once('includes/functions.php');

$page_title='Archiwum';

if (!isset($_GET['actor']) || (!(is_numeric($_GET['actor'])))) { $_GET['actor']=-1; }

if ($_GET['actor']>0) {
  $q = mysql_query("SELECT strips.* FROM actors_list, strips WHERE actors_list.actor_id=".$_GET['actor']." AND strips.id=actors_list.strip_id ORDER BY strips.id DESC") or print mysql_error();
  if (mysql_num_rows($q)>0) {
    $archive['actor']=mysql_fetch_array(mysql_query('SELECT * FROM actors WHERE id='.$_GET['actor']));
  }
  else $q = mysql_query("SELECT * FROM strips ORDER BY id DESC");
}
else {
  $q = mysql_query("SELECT * FROM strips ORDER BY id DESC");
}

include_once('themes/'.$_CONFIG['theme'].'/functions/archive.php');

$archive['title']="Archiwum";

if ($_GET['actor']>0) {
  $archive['content']='<p class="bydate"><a href="/archive/">wg. daty</a>・<span>wg. występujących</span></p><p>';
  $desc='';
  $m = mysql_query("SELECT DISTINCT actors.* FROM actors_list, actors WHERE actors.id=actors_list.actor_id ORDER BY actors.id;");
  while ($row = mysql_fetch_assoc($m)) {
    $style='';
    if ($row['id']==$_GET['actor']) $style="selected";
    $archive['content'].='<a href="/archive/'.$row['id'].'/" class="actor '.$style.'"><img width="50" height="50" src="/images/avatars/'.$row['avatar'].'" />'.$row['name'].'</a>';
  }
  $archive['content'].="</p><p class=\"desc\"><b>".$archive['actor']['name'].":</b> ".$archive['actor']['description']."</p>";
}
else {
  $archive['content']='<p class="byactor"><span>wg. daty</span>・<a href="/archive/1/">wg. występujących</a></p>';
}

$oldmonth='';

while ($row = mysql_fetch_assoc($q)) {
  if ($oldmonth!=date("m-Y",strtotime($row['date']))) {
    $archive['content'].=theme_archive_month(strtotime($row['date']));
  }
  $archive['content'].=theme_archive($row);
  $oldmonth=date("m-Y",strtotime($row['date']));
}

include_once('themes/'.$_CONFIG['theme'].'/archive.php');
