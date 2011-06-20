<?
include('header.php');
function theme_navigation($comic) {
?>
<p class="nav"><a href="/<?= $comic['nav']['first'] ?>">&lt;&lt;</a> <a href="/<?= $comic['nav']['prev'] ?>">&lt;</a> <a href="/<?= $comic['nav']['random'] ?>">RANDUM</a> <a href="/<?= $comic['nav']['next'] ?>">&gt;</a> <a href="/">&gt;&gt;</a></p>
<?
}

?>
<div id="strip">
<h2><?= $comic['name'] ?></h2>
<? theme_navigation($comic) ?>

<? $size = getimagesize($comic['src']);
   if ($size[0]>$_THEME['width']) {
$height = $_THEME['width'] / ($size[0]/$size[1]);
 ?>
<a href="/<?= $comic['src'] ?>"><img src="/thumbnail/<?= $_THEME['width'] ?>/<?= $comic['src'] ?>" title="<?= $comic['title'] ?>" width="<?= $_THEME['width'] ?>" height="<?= $height ?>" /></a>
  <? } else {?>
<img src="/<?= $comic['src'] ?>" title="<?= $comic['title'] ?>" <?= $size[3] ?>/>
<? } ?>
<p><?= $comic['comment'] ?></p>
<p class="share"><fb:like style="position: relative; top: -4px;" layout="button_count" action="like" href="<?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/"></fb:like>
<a href="http://twitter.com/share" class="twitter-share-button" data-count="none" style="margin: 0px; padding: 0px;">Tweet</a></p>
<? theme_navigation($comic) ?>
<p class="permalink">Permalink: <?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/<br/>
URL: <?= $_CONFIG['siteurl'] ?><?= $comic['src'] ?></p>
</div>

<div id="comments">
<h4>Komcie</h4>
<?= $page_comments ?></div>

<?include('footer.php');?>
