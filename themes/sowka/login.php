<?
$_SOWKA['top']="<h2>".$login['title']."</h2>";
include('header.php');?>
<div id="login">
<p><?= $login['content'] ?></p>
<!--
<?
if ($_USER) {
  print "<p>Witaj, ".$_USER['name']." ".$_USER['surname']."!</p>";
}
else {
?>
<p><fb:login-button perms="email" onlogin="window.location.reload(true);">Zaloguj przez Facebooka</fb:login-button></p>
<? } ?>-->
</div>
<?include('footer.php');?>
