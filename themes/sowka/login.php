<?
$_SOWKA['top']="<h2>".$login['title']."</h2>";
include('header.php');?>
<div id="login">
<? if ($login['loginform']) { 
if ($login['error']) {
?>
<p class="error"><?=$login['error']?></p>
<? } ?>
<form method="POST">
<table>
<tr><td>Login:</td>
<td><input type="text" name="login" value="<?=htmlspecialchars($_POST['login'])?>" /></td></tr>
<tr><td>Hasło:</td><td><input type="password" name="pass" /></td></tr>
<tr><td class="info" colspan="2"><input type="submit" value="Zaloguj" /></td></tr>
</table>
</form>
<div><p>Zaloguj przy pomocy...</p>
<p>
<?
$return_url='';
if ($_GET['blog'])
$returl_url='/blog/'.$_GET['blog'];
if ($_GET['comic'])
$return_url='/'.$_GET['comic'];
?>
<fb:login-button class="login-facebook" perms="email" onlogin="window.location.reload(true)">Facebook</fb:login-button> 
<a href="<?=$return_url?>/login/google/" class="login-google">Konto Google</a> 
<a href="<?=$return_url?>/login/openid/" class="login-openid">OpenID</a>
</p>

</div>
<p>Nie masz konta? <a href="/register/">Zarejestruj się!</a></div>
<? } ?>

<? if ($login['content']) { ?>
<?= $login['content'] ?>
<? } ?>
</div>
<?include('footer.php');?>
