<?
$_SOWKA['top']="<h2>".$profile['title']."</h2>";
include('header.php');?>
<div id="profile">
<? if (($profile['me']) && (!$_USER['logged_in_by_fb'])) echo '<p class="logout"><a href="/logout/">Wyloguj mnie</a></p>'; ?>
<img class="avatar" src="<?=$profile['avatar']?>" width="50" height="50" />
<p class="name"><?=htmlspecialchars($profile['fullname'])?></p>
<p class="nickname"><?=htmlspecialchars($profile['nickname'])?></p>
<p class="link"><?=htmlspecialchars($profile['link'])?></p>
<p class="comment_count">Komentarzy: <?=$profile['comment_count']?></p>
<p class="about"><?=htmlspecialchars($profile['about'])?></p>
<?
if ($profile['me']) {
?>
<h3>Edycja danych</h3>
<form method="POST">
<table>
<tr><td>Imię:</td><td><input type="text" name="name" value="<?= htmlspecialchars($profile['name']) ?>" /></tr>
<tr><td>Nazwisko:</td><td><input type="text" name="surname" value="<?= htmlspecialchars($profile['surname']) ?>" /></tr>
<tr><td>Nazwa wyświetlana:</td><td><input type="text" name="nickname" value="<?= htmlspecialchars($profile['nickname']) ?>" /></tr>
<tr><td>Adres e-mail:</td><td><input type="email" name="mail" pattern="[^ @]*@[^ @]*" value="<?= htmlspecialchars($profile['mail']) ?>" /></tr>
<tr><td>O mnie:</td><td><textarea name="about"><?= htmlspecialchars($profile['about']) ?></textarea></td></tr>
<tr><td class="info" colspan="2"><input type="submit" value="Wyślij" /></td></tr>
<? if (!$profile['login-active']) { ?>
<tr><td class="info" colspan="2">Brak ustawionej nazwy użytkownika. Ustaw ją, wraz z hasłem, w polach poniżej, aby umożliwić logowanie bez użycia zewnętrznych serwisów.</td></tr>
<tr><td>Login:</td><td><input type="text" name="login" value="<?= htmlspecialchars($profile['login']) ?>" /></tr>
<tr><td>Hasło:</td><td><input type="password" name="pass" /></tr>
<tr><td>Powtórz hasło:</td><td><input type="password" name="pass2" /></tr>
<tr><td class="info" colspan="2"><input type="submit" value="Wyślij" /></td></tr>
<? } ?>

</table>
</form>
<h4>Usługi zewnętrzne</h4>
<p class="services">Profil został zarejestrowany przy użyciu następujących usług:
<ul>
<?
foreach ($profile['services'] as $service) {
  print '<li>'.$service.'</li>';
}
?>
</ul>
</p>

<? } ?>
</div>
<?include('footer.php');?>
