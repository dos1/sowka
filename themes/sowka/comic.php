<?
function theme_navigation($comic) {
global $comic;
$nav  = "<p class=\"nav\">";
if ($comic['nav']['first']==$comic['id']) {
	$klasa="class=\"disabled\"";
}
else { $klasa=''; }
$nav .= "<a title=\"Pierwszy pasek\" $klasa href=\"/". $comic['nav']['first'] ."/\">&lt;&lt;</a> ";
$nav .= "<a title=\"Poprzedni pasek\" $klasa href=\"/". $comic['nav']['prev'] ."/\">&lt;</a> ";
$nav .= "<a title=\"Losowy pasek\" href=\"/". $comic['nav']['random'] ."/\">Wylosuj</a> ";
if ($comic['nav']['next']==$comic['id']) {
        $klasa="class=\"disabled\"";
}
else { $klasa=''; }
$nav .= "<a title=\"Następny pasek\" $klasa href=\"/". $comic['nav']['next'] ."/\">&gt;</a> ";
$nav .= "<a title=\"Najnowszy pasek\" $klasa href=\"/\">&gt;&gt;</a>";
$nav .= "</p>";
return $nav;
}
$_SOWKA['top']="<h2 class=\"main comic\">".$comic['name']."</h2>".theme_navigation($comic);

include('header.php');

?>
<div id="strip">

<? $size = getimagesize($comic['src']);
   if ($size[0]>$_THEME['width']) {
$height = $_THEME['width'] / ($size[0]/$size[1]);
 ?>
<a href="/<?= $comic['src'] ?>"><img src="/thumbnail/<?= $_THEME['width'] ?>/<?= $comic['src'] ?>" alt="Komiks" title="<?= $comic['title'] ?>" width="<?= $_THEME['width'] ?>" height="<?= $height ?>" /></a>
  <? } else {?>
<img src="/<?= $comic['src'] ?>" alt="Komiks" title="<?= $comic['title'] ?>" width="<?= $size[0] ?>" />
<? } ?>

<div id="actors">
<p>Wystąpili</p>
<?
foreach ($comic['actors'] as $actor) {
?>
<a href="/archive/<?=$actor['id']?>/" class="actor">
<img width="50" height="50" src="/images/avatars/<?=$actor['avatar']?>"/>
<?=$actor['name'];?></a>
<?
}
?>
</div>

<p><?= $comic['comment'] ?></p>

<div class="share">
<?
$facebook_enable = true;
$twitter_enable = true;
$buzz_enable = true;
$plusone_enable = true;
?>
<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
<a title="Publikuj w usłudze Google Buzz" class="google-buzz-button" style="position: relative; top: -6px;" href="http://www.google.com/buzz/post" data-button-style="small-button" data-locale="pl"></a>
<g:plusone size="medium" style="position: relative; top: -6px;" count="false" href="<?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/"></g:plusone>
<fb:like style="position: relative; top: -4px;" layout="button_count" href="<?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/"></fb:like>
</div>
<?= theme_navigation($comic);
setlocale(LC_ALL, 'pl_PL'); ?>
<p class="permalink">Data: <?= strftime('%d %B %Y', strtotime($comic['date'])) ?><br />Permalink: <?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/<br/>
URL: <?= $_CONFIG['siteurl'] ?><?= $comic['src'] ?></p>
</div>



<div id="comments">
<h4>Komentarze</h4>
<?= $page_comments ?>
</div>
<?= show_ads() ?>
<p class="toplists" style="text-align: center"><a href="http://komiksy.toplista.pl/?we=dos"><span style="width:120px;height:40px;overflow:hidden;background:#EE8800;border:2px;border-color:#FFAA22;border-style:outset;padding:5px;font:bold 11px verdana;color:white;text-decoration:none;text-align:center;cursor:pointer">Toplista Komiksy</span></a> <a href="http://komiks.toplista.pl/?we=sowka"><span style="width:120px;height:40px;overflow:hidden;background:#EE0000;border:2px;border-color:#FF2222;border-style:outset;padding:5px;font:bold 11px verdana;color:white;text-decoration:none;text-align:center;cursor:pointer">Toplista Komiks</span></a></p>
<?include('footer.php');?>
