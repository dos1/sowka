<?include('header.php');?>
<div id="strip">
<h2><?= $comic['name'] ?></h2>
<img src="<?= $comic['src'] ?>" title="<?= $comic['title'] ?>" />
<p><?= $comic['comment'] ?></p>
</div>
<hr />

<p>Komcie: </p>
<div><?= $page_comments ?></div>

<?include('footer.php');?>
