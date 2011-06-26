<?
include_once('includes/functions.php');

$q = mysql_query("SELECT * FROM strips ORDER BY id DESC");

include_once('themes/'.$_CONFIG['theme'].'/functions/archive.php');

$archive['title']="Archiwum";
$archive['content']='';

$oldmonth='';

while ($row = mysql_fetch_assoc($q)) {
$lol=$row;
  if ($oldmonth!=date("m-Y",strtotime($row['date']))) {
    $archive['content'].=theme_archive_month(strtotime($row['date']));
  }
  $archive['content'].=theme_archive($row);
  $oldmonth=date("m-Y",strtotime($row['date']));
}
$row=$lol;
$archive['content'].=theme_archive_month(1);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row); 
$archive['content'].=theme_archive($row); 
$archive['content'].=theme_archive($row); 

$archive['content'].=theme_archive_month(10000000);
$archive['content'].=theme_archive($row);

$archive['content'].=theme_archive_month(16460475);
$archive['content'].=theme_archive($row); 

$archive['content'].=theme_archive_month(1547457547);
$archive['content'].=theme_archive($row); 

$archive['content'].=theme_archive_month(5475547541);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);


$archive['content'].=theme_archive_month(1547547);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);
$archive['content'].=theme_archive($row);

include_once('themes/'.$_CONFIG['theme'].'/archive.php');
