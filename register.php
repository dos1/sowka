<?
include_once('includes/functions.php');

$page_title='Rejestracja';

$profile['me']=false;

if (isset($_USER)) {
  header('Location: '.$_CONFIG['siteurl']);
  die();
}

$profile['display-form']=1;

if ($_POST) {

  foreach ($_POST as $key => $value) {
    $profile[$key]=$value;
  }

  if (!(($_POST['name']) && ($_POST['login']) && (($_POST['pass']) || ($_POST['pass2'])) && ($_POST['surname']) && ($_POST['nickname']) && ($_POST['mail']))) {
    $profile['error']='Nie wypełniono wszystkich pól.';
  }
  else if ($_POST['validate']!='8') {
    $profile['error']='Wprowadzono niepoprawny wynik działania.';
  }
  else if (!validEmail($_POST['mail'])) {
    $profile['error']='Wprowadzono niepoprawny adres e-mail.';
  }
  else if (mysql_num_rows(mysql_query(sprintf("SELECT * FROM users WHERE `login-active`=1 AND `login` = '%s'", mysql_real_escape_string($_POST['login']))))>0) {
    $profile['error']='Podany login został już zajęty.';
  }
  else if ($_POST['pass']!=$_POST['pass2']) {
    $profile['error']='Wprowadzone hasła nie pasują do siebie.';
  }
  else {
    $error = 0;
    mysql_query(sprintf("INSERT INTO users SET `login` = '%s', `login-active`=1, `pass`='%s', `name`='%s', `surname`='%s', `nickname`='%s', `mail`='%s', `link`='%s', `about`='%s'", mysql_real_escape_string($_POST['login']), mysql_real_escape_string(hash('sha512','45Sówkalsk45adso238if:):D'.$_POST['pass'].'a\':LM:>').'d'), mysql_real_escape_string($_POST['name']),
                mysql_real_escape_string($_POST['surname']), mysql_real_escape_string($_POST['nickname']), mysql_real_escape_string($_POST['mail']), mysql_real_escape_string($_POST['link']), mysql_real_escape_string($_POST['about']))) or $error=1;
    if ($error) {
      $profile['error']='Błąd: '.mysql_error();
    } else {
      $profile['messages'][]='Rejestracja zakończona pomyślnie.<br/><a href="/login/">Zaloguj się</a>!';
      $profile['display-form']=0;
    }
  }
}

$profile['title']='Rejestracja';

include_once('themes/'.$_CONFIG['theme'].'/register.php');
