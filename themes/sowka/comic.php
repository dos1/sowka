<?
function theme_navigation($comic) {
global $comic;
return "<p class=\"nav\"><a href=\"/". $comic['nav']['first'] ."/\">&lt;&lt;</a> <a href=\"/". $comic['nav']['prev'] ."/\">&lt;</a> <a href=\"/". $comic['nav']['random'] ."/\">Wylosuj</a> <a href=\"/". $comic['nav']['next'] ."/\">&gt;</a> <a href=\"/\">&gt;&gt;</a> </p>";
}
$_SOWKA['top']="<h2 class=\"main\">".$comic['name']."</h2>".theme_navigation($comic);

include('header.php');

?>
<div id="strip">

<? $size = getimagesize($comic['src']);
   if ($size[0]>$_THEME['width']) {
$height = $_THEME['width'] / ($size[0]/$size[1]);
 ?>
<a href="/<?= $comic['src'] ?>"><img src="/thumbnail/<?= $_THEME['width'] ?>/<?= $comic['src'] ?>" title="<?= $comic['title'] ?>" width="<?= $_THEME['width'] ?>" height="<?= $height ?>" /></a>
  <? } else {?>
<img src="/<?= $comic['src'] ?>" title="<?= $comic['title'] ?>" <?= $size[3] ?>/>
<? } ?>
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
<g:plusone size="medium" style="position: relative; top: -6px;" count="false"></g:plusone>
<fb:like style="position: relative; top: -4px;" layout="button_count" href="<?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/"></fb:like>
</div>
<?= theme_navigation($comic) ?>
<p class="permalink">Permalink: <?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/<br/>
URL: <?= $_CONFIG['siteurl'] ?><?= $comic['src'] ?></p>
</div>

<div id="comments">
<h4>Komentarze</h4>
<?= $page_comments ?></div>

<?include('footer.php');?>
