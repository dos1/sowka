<?
if (isset($archive['actor'])) {
$_SOWKA['top']="<h2 class=\"main\">".$archive['title']."</h2><p class=\"p2rd\">".$archive['actor']['name']."</p>";
}
else {
$_SOWKA['top']="<h2>".$archive['title']."</h2>";
}
include('header.php');?>
<div id="archive">
<div><?= $archive['content'] ?></div>
</div>
<?include('footer.php');?>
