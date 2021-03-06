<?
$_THEME['width'] = 786;
$facebook_enable = true;
?><? /*echo '<?xml version="1.0" encoding="utf-8"?>';
   echo '<?xml-stylesheet type="text/css" href="/themes/default/style.css"?>';*/
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="pl">
<head>
<meta charset="utf-8" />
<title><?= $_CONFIG['sitename'] ?><? if ($page_title) { echo " - ".$page_title; } ?></title>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<![endif]-->
<meta property="og:title" content="<? echo $_CONFIG['sitename']; if ($page_title) { echo ' - '.$page_title; } ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<? if ($page_permalink) { echo $page_permalink; } else { echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; }; ?>" />
<meta property="og:image" content="<? if ($page_image) { echo $page_image; } else { echo $_CONFIG['siteurl'].$_CONFIG['comics_path'].'logo.png'; } ?>" />
<meta property="og:site_name" content="<?= $_CONFIG['sitename'] ?>" />
<meta property="fb:admins" content="<?= $_CONFIG['fb']['admins'] ?>" />
<meta property="fb:app_id" content="<?= $_CONFIG['fb']['appid'] ?>"/>

<meta name="description" content="Komiks internetowy o sympatycznej Sówce mieszkającej na drzewie w ogródku u Pana Człowieka. Nowy pasek w co drugą środę!" />
<meta name="keywords" content="sówka,sowa,sowy,komiks,comic,webcomic,drzewo,ptak,ptaki,humor,rysunek,webkomiks" />
<meta name="author" content="Agata Kurczewska" />
<meta name="content-title" content="Sówka" />
<meta name="content-language" content="pl" />
<meta name="robots" content="index, follow" />
<link rel="index" title="Sówka" href="/" />
<link rel="alternate" type="application/rss+xml" title="Sówka - Komiks" href="/rss/" />

<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style.css?r3" />
<!--[if IE]>
<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style-ie.css" />
<![endif]-->
<!--[if lte IE 8]>
<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style-ie8.css" />
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lte IE 7]>
<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style-ie7.css" />
<![endif]-->
<!--[if lte IE 6]>
<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style-ie6.css" />
<script type="text/javascript" src="/themes/<?= $_CONFIG['theme'] ?>/supersleight-min.js"></script>
<![endif]-->
<?
  $ua = getBrowser();
  if (($ua['name']=='Opera') && ($ua['version']<=11.50)) {
    print '<link rel="stylesheet" href="/themes/'.$_CONFIG['theme'].'/style-opera.css" />';
  }
?>

<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style-narrow.css?r2" type="text/css" media="all and (max-device-width: 1100px)" />

<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style-verynarrow.css?r2" type="text/css" media="all and (max-device-width: 1023px)" />

<meta name="viewport" content="width=800"/>

<link rel="shortcut icon" href="/favicon.png" />
<script src="/themes/<?= $_CONFIG['theme'] ?>/blinkeyes.js" async="async" type="text/javascript"></script>

<? if ($_CONFIG['GA-account']) { ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?= $_CONFIG['GA-account']; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<? } ?>

</head>
<body>
<?/*<div id="devwarning"><!--[if !IE]>--><b>Ostrzeżenie:</b> Wersja developerska. Treść jest przykładowa i nie wszystko jeszcze działa lub wygląda tak, jak powinno!<!--<![endif]-->*/?>
<!--[if IE]><div id="devwarning"><b>Ostrzeżenie:</b> Używasz <![if lte IE 6]><b><i>BARDZO</i></b> <![endif]>starej przeglądarki, <i>Internet Explorer</i>, która nie potrafi poprawnie 
wyświetlić tej strony. <a href="http://browsehappy.pl/">Dowiedz się więcej</a></div>
<![endif]-->
<div id="logo">
<h1 id="header-sowka-logo"><a href="/"><?= $_CONFIG['sitename'] ?></a></h1>
<div id="topnav">
<a href="/rss/" class="rss">RSS</a>
</div>
<div id="nav">
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);"  href="/">Komiks</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" href="/archive/">Archiwum</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" href="/blog/">Blog</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" href="/about/">O Sówce</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" <? if (isset($_USER)) { ?> href="/profile/">Mój profil<?} else { ?> href="/login/">Zaloguj<? } ?></a>
</div>
<p class="like">
<fb:like class="likeme" href="http://www.facebook.com/pages/S%C3%B3wka/128583487224662"></fb:like>
<a target="_blank" href="http://www.facebook.com/pages/S%C3%B3wka/128583487224662">Sówka na Facebooku</a>
</p>
</div>
<div id="wrapper">
<? if ($_SOWKA['top']) { ?>
<div id="top">
<?= $_SOWKA['top'] ?>
</div>
<? } ?>
<div id="content">
