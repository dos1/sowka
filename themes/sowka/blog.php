<?
setlocale(LC_ALL, 'pl_PL');
$_SOWKA['top']="<h2 class=\"main\">".$blog['name']."</h2><p class=\"p2rd\">".strftime("%d %B %Y, %H:%M:%S", strtotime($blog['date']))."</p>";
if ($blog['nav']['prev']) {
$_SOWKA['top'].="<a href=\"/blog/".$blog['nav']['prev']['id']."/\" class=\"link-prev\">&lt; ". $blog['nav']['prev']['name']."</a>";
}
if ($blog['nav']['next']) {
$_SOWKA['top'].="<a href=\"/blog/".$blog['nav']['next']['id']."/\" class=\"link-next\">". $blog['nav']['next']['name']." &gt;</a>";
}
include('header.php');?>
<div id="blog">
<div class="author">
  <img src="/images/avatars/<?=$blog['author']['avatar']?>" />
  <div>
    <span id="blog-author-con"><? if ($blog['author']['male']) { print 'Autorem'; } else { print 'Autorką'; } ?> tego wpisu jest:</span>
    <span id="blog-author-name"><?=$blog['author']['name']?></span>
    <span id="blog-author-role"><?=$blog['author']['title']?></span>
  </div>
</div>
<p><?= $blog['content'] ?></p>
<p class="nav">
<? if ($blog['nav']['prev']) { ?>
<a href="/blog/<?= $blog['nav']['prev']['id'] ?>/" style="float: left">&lt; <?= $blog['nav']['prev']['name'] ?></a>
<? } if ($blog['nav']['next']) { ?>
<a href="/blog/<?= $blog['nav']['next']['id'] ?>/" style="float: right"><?= $blog['nav']['next']['name'] ?> &gt;</a>
<? } ?>
</p>
<br style="clear: both" />
</div>

<div id="comments">
<h4>Komentarze</h4>
<?= $page_comments ?></div>
<?= show_ads(); ?>
<?include('footer.php');?>
