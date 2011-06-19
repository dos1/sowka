<?include('header.php');?>
<div id="blog">
<h2><?= $blog['name'] ?></h2>
<p><?= $blog['content'] ?></p>
<p class="nav"><a>&lt;</a> <a>&gt;</a></p>
</div>

<div id="comments">
<h4>Komcie</h4>
<?= $page_comments ?></div>

<?include('footer.php');?>
