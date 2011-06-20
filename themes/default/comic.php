<?
include('header.php');
function theme_navigation($comic) {
?>
<p class="nav"><a href="/<?= $comic['nav']['last'] ?>">&lt;&lt;</a> <a href="/<?= $comic['nav']['prev'] ?>">&lt;</a> <a href="/<?= $comic['nav']['random'] ?>">RANDUM</a> <a href="/<?= $comic['nav']['next'] ?>">&gt;</a> <a href="/<?= $comic['nav']['first'] ?>">&gt;&gt;</a></p>
<?
}

?>
<div id="strip">
<h2><?= $comic['name'] ?></h2>
<? theme_navigation($comic) ?>
<img src="/<?= $comic['src'] ?>" title="<?= $comic['title'] ?>" />
<p><?= $comic['comment'] ?></p>
<? theme_navigation($comic) ?>
<p class="permalink">Permalink: <?= $_CONFIG['siteurl'] ?><?= $comic['id'] ?>/<br/>
URL: <?= $_CONFIG['siteurl'] ?><?= $comic['src'] ?></p>
</div>

<div id="comments">
<h4>Komcie</h4>
<?= $page_comments ?></div>

<?include('footer.php');?>
