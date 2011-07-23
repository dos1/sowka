<?
$_SOWKA['top']="<h2>".$profile['title']."</h2>";
include('header.php');?>
<div id="profile">
<? if (($profile['me']) && (!$_USER['logged_in_by_fb'])) echo '<p class="logout"><a href="/logout/">Wyloguj mnie</a></p>'; ?>
<div class="userinfo">
<img class="avatar" src="<?=$profile['avatar']?>" width="50" height="50" />
<div>
<p class="nickname"><?=htmlspecialchars($profile['nickname'])?></p>
<p class="name"><?=htmlspecialchars($profile['fullname'])?></p>
<p class="link"><a href="<?=htmlspecialchars($profile['link'])?>"><?=htmlspecialchars($profile['link'])?></a></p>
</div>
</div>
<? if ($profile['admin']) { ?> <p class="admin">Administrator</p> <? } ?>
<p class="comment_count">Komentarzy: <?=$profile['comment_count']?></p>
<? if ($profile['about']) { ?><p class="about"><?=htmlspecialchars($profile['about'])?></p><? } ?>
<?
if ($profile['me']) {
?>
<form method="POST">
<h3>Edycja danych</h3>
<? if ($profile['error']) { ?>
<p class="error"><?= $profile['error']?></p>
<? }
foreach ($profile['messages'] as $message) {
  print "<p class=\"message\">".$message."</p>";
}
 ?>
<table>
<? if ((!$profile['gravatar']) && (!($profile['facebook']))) { ?>
<tr><td class="info" colspan="2" style="padding-bottom: 20px"><a href="http://pl.gravatar.com/site/signup/">Ustaw avatar</a></td></tr>
<? } else if (($profile['gravatar']) && (!($profile['facebook']))) { ?>
<tr><td class="info" colspan="2" style="padding-bottom: 20px"><a href="http://pl.gravatar.com/site/login/">Zmień avatar</a></td></tr>
<? } ?>
<tr><td>Imię:</td><td><input type="text" name="name" value="<?= htmlspecialchars($profile['name']) ?>" /></td></tr>
<tr><td>Nazwisko:</td><td><input type="text" name="surname" value="<?= htmlspecialchars($profile['surname']) ?>" /></td></tr>
<tr><td>Nazwa wyświetlana:</td><td><input type="text" name="nickname" value="<?= htmlspecialchars($profile['nickname']) ?>" /></td></tr>
<tr><td>Adres e-mail:</td><td><input type="email" name="mail" pattern="[^ @]*@[^ @]*" value="<?= htmlspecialchars($profile['mail']) ?>" /></td></tr>
<tr><td>Adres WWW:</td><td><input type="url" name="link" value="<?= htmlspecialchars($profile['link']) ?>" /></td></tr>
<tr><td>O mnie:</td><td><textarea name="about"><?= htmlspecialchars($profile['about']) ?></textarea></td></tr>
<tr><td class="info" colspan="2"><input type="submit" value="Wyślij" /></td></tr>
<? if (!$profile['login-active']) { ?>
<tr><td class="info" colspan="2">Brak ustawionej nazwy użytkownika. Ustaw ją, wraz z hasłem, w polach poniżej, aby umożliwić logowanie bez użycia zewnętrznych serwisów. Ustawionej nazwy nie można potem zmienić.</td></tr>
<tr><td>Login:</td><td><input type="text" name="login" value="<?= htmlspecialchars($profile['login']) ?>" /></td></tr>
<tr><td>Hasło:</td><td><input type="password" name="pass" /></td></tr>
<tr><td>Powtórz hasło:</td><td><input type="password" name="pass2" /></td></tr>
<? } else { ?>
<tr><td class="info" colspan="2">Jeśli chcesz zmienić swoje hasło, wypełnij formularz poniżej. W przeciwnym razie - pozostaw pola puste.</td></tr>
<tr><td>Login:</td><td class="login"><?= htmlspecialchars($profile['login']) ?></td></tr>
<tr><td>Stare hasło:</td><td><input type="password" name="oldpass" /></td></tr>
<tr><td>Nowe hasło:</td><td><input type="password" name="pass" /></td></tr>
<tr><td>Powtórz nowe hasło:</td><td><input type="password" name="pass2" /></td></tr>
<? } ?>
<tr><td class="info" colspan="2"><input type="submit" value="Wyślij" /></td></tr>
</table>
</form>
<h4>Usługi zewnętrzne</h4>
<p class="services">Profil został zarejestrowany przy użyciu następujących usług:</p>
<ul class="services">
<?
$services_left='';
$is_service = 0;
foreach ($profile['services'] as $service => $val) {
  if ($val) {
    $is_service = 1;
    print '<li>'.$service.'</li>';
  }
  else {
    if ($service=='Facebook') $services_left.="<fb:login-button class=\"login-facebook\" perms=\"email\" onlogin=\"window.location='".$_CONFIG['siteurl'].'profile/facebook/'."';\">Facebook</fb:login-button> ";
    elseif ($service=='Konta Google') $services_left.="<a href=\"/profile/google/\" class=\"login-google\">Konto Google</a> ";
    elseif ($service=='OpenID') $services_left.="<a href=\"/profile/openid/\" class=\"login-openid\">OpenID</a>";
  }
}
if (!$is_service) {
 print '<li>brak zewnętrznych serwisów</li>';
}
?>
</ul>
<? if ($services_left) { ?>
<h5>Dodaj usługę</h5>
<p>
<?= $services_left ?>
</p>
<? } } ?>
</div>
<?include('footer.php');?>
