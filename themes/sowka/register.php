<?
$_SOWKA['top']="<h2>".$profile['title']."</h2>";
include('header.php');?>
<div id="register">

<form method="POST">
<h3>Rejestracja</h3>
<? if ($profile['error']) { ?>
<p class="error"><?= $profile['error']?></p>
<? }
foreach ($profile['messages'] as $message) {
  print "<p class=\"message\">".$message."</p>";
}
 ?>
<? if ($profile['display-form']) { ?>
<table>
<tr><td>* Login:</td><td><input type="text" required="required" name="login" value="<?= htmlspecialchars($profile['login']) ?>" /></td></tr>
<tr><td>* Hasło:</td><td><input type="password" required="required" name="pass" /></td></tr>
<tr><td>* Powtórz hasło:</td><td><input type="password" required="required" name="pass2" /></td></tr>
<tr><td>* Imię:</td><td><input type="text" required="required" name="name" value="<?= htmlspecialchars($profile['name']) ?>" /></td></tr>
<tr><td>* Nazwisko:</td><td><input type="text" required="required" name="surname" value="<?= htmlspecialchars($profile['surname']) ?>" /></td></tr>
<tr><td>* Nazwa wyświetlana:</td><td><input type="text" required="required" name="nickname" value="<?= htmlspecialchars($profile['nickname']) ?>" /></td></tr>
<tr><td>* Adres e-mail:</td><td><input type="email" required="required" name="mail" pattern="[^ @]*@[^ @]*" value="<?= htmlspecialchars($profile['mail']) ?>" /></td></tr>
<tr><td>* 5+3=</td><td><input type="text" required="required" name="validate" value="<?= htmlspecialchars($profile['validate']) ?>" /></td></tr>
<tr><td>Adres WWW:</td><td><input type="url" name="link" value="<?= htmlspecialchars($profile['link']) ?>" /></td></tr>
<tr><td>O mnie:</td><td><textarea name="about"><?= htmlspecialchars($profile['about']) ?></textarea></td></tr>
<tr><td class="info" colspan="2"><input type="submit" value="Wyślij" /></td></tr>
<tr><td class="info" colspan="2">Pola oznaczone gwiazdką są wymagane.</td></tr>
</table>
<? } ?>
</form>

</div>
<?include('footer.php');?>
