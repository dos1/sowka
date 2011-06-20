<?include('header.php');?>
<div id="blog">
<h2><?= $blog['name'] ?></h2>
<p style="text-align: right"><?= $blog['date'] ?></p>
<p><?= $blog['content'] ?></p>
<p class="nav">
<? if ($blog['nav']['prev']) { ?>
<a href="/blog/<?= $blog['nav']['prev']['id'] ?>" style="float: left">&lt; <?= $blog['nav']['prev']['name'] ?></a>
<? } if ($blog['nav']['next']) { ?>
<a href="/blog/<?= $blog['nav']['next']['id'] ?>" style="float: right"><?= $blog['nav']['next']['name'] ?> &gt;</a>
<? } ?>
</p>
<br style="clear: both" />
</div>

<div id="comments">
<h4>Komcie</h4>
<?= $page_comments ?></div>

<?include('footer.php');?>
