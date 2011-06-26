<?
$_SOWKA['top']="<h2>".$login['title']."</h2>";
include('header.php');?>
<div id="login">
<p><?= $login['content'] ?></p>
<p><fb:login-button>Zaloguj przez Facebooka</fb:login-button></p>
</div>
<?include('footer.php');?>
