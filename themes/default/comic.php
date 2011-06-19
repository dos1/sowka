<?include('header.php');?>
<div id="strip">
<h2><?= $comic['name'] ?></h2>
<p class="nav"><a>&lt;&lt;</a> <a>&lt;</a> <a>RANDUM</a> <a>&gt;</a> <a>&gt;&gt;</a></p>
<img src="<?= $comic['src'] ?>" title="<?= $comic['title'] ?>" />
<p><?= $comic['comment'] ?></p>
<p class="nav"><a>&lt;&lt;</a> <a>&lt;</a> <a>RANDUM</a> <a>&gt;</a> <a>&gt;&gt;</a></p>
</div>

<div id="comments">
<h4>Komcie</h4>
<?= $page_comments ?></div>

<?include('footer.php');?>
