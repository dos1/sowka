<?


function array_sort($array, $on, $order='DESC')
{
  $new_array = array();
  $sortable_array = array();

  if (count($array) > 0) {
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        foreach ($v as $k2 => $v2) {
           if ($k2 == $on) {
             $sortable_array[$k] = $v2;
           }
        }
      } else {
        $sortable_array[$k] = $v;
      }
    }

    switch($order)
    {
      case 'ASC':
        asort($sortable_array);
        break;
      case 'DESC':
        arsort($sortable_array);
        break;
    }

    foreach($sortable_array as $k => $v) {
      $new_array[] = $array[$k];
    }
  }
  return $new_array;
}

header("Content-type: text/xml; charset=utf-8");

include("includes/functions.php");


$data=date('r');
echo('<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
 <channel>
 <generator>Sówka</generator>
 <lastBuildDate>'.$data.'</lastBuildDate>
  <title>'.$_CONFIG['sitename'].'</title>
  <link>'.$_CONFIG['siteurl'].'</link>
  <description><![CDATA[Nowe paski oraz wpisy na blogu.]]></description>
  <language>pl</language>
  <copyright>Sebastian Krzyszkowiak, Agata Kurczewska</copyright>
  <managingEditor>agata@sowka.art.pl</managingEditor>
  <webMaster>dos@sowka.art.pl</webMaster>
  <ttl>60</ttl>
  <pubDate>'.$data.'</pubDate>');

$wynik = mysql_query("SELECT * FROM blog");
while ($row=mysql_fetch_assoc($wynik)) {
  $row['type']='blog';
  $news[]=$row;
}
$wynik = mysql_query("SELECT * FROM strips");
while ($row=mysql_fetch_assoc($wynik)) {
  $row['type']='strip';
  $news[]=$row;
}

$list=array_sort($news,'date');

foreach ($list as $news) {
  if ($news['type']=='strip') {
    echo('
     <item>
       <title>'.$news['name'].'</title>
       <link><![CDATA['.$_CONFIG['siteurl'].$news['id'].']]></link>
       <pubDate>'.date('r',strtotime($news['date'])).'</pubDate>
       <description><![CDATA[<p><img src="'.$_CONFIG['siteurl'].$_CONFIG['comics_path'].$news['src'].'" alt="Komiks" title="'.$news['title'].'"/></p>'.$news['comment'].']]></description>
     </item>
    ');
  }
  else {
    echo('
     <item>
       <title>Blog - '.$news['name'].'</title>
       <link><![CDATA['.$_CONFIG['siteurl'].'blog/'.$news['id'].']]></link>
       <pubDate>'.date('r',strtotime($news['date'])).'</pubDate>
       <description><![CDATA['.$news['content'].']]></description>
     </item>
    ');
  }
}

echo('
 </channel>
</rss>');
?>
