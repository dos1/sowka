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
  <img src="http://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/195648_1799748123_6359960_q.jpg" />
  <div>
    <span id="blog-author-con">Autorem tego wpisu jest:</span>
    <span id="blog-author-name">Sebastian Krzyszkowiak</span>
    <span id="blog-author-role">Administrator strony</span>
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

<?include('footer.php');?>
