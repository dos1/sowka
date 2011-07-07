<?
$_THEME['width'] = 786;
?>
<? /*echo '<?xml version="1.0" encoding="utf-8"?>';
   echo '<?xml-stylesheet type="text/css" href="/themes/default/style.css"?>';*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="pl">
<head>
<meta charset="utf-8" />
<title><?= $_CONFIG['sitename'] ?><? if ($page_title) { echo " - ".$page_title; } ?></title>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<![endif]-->

<meta name="robots" content="noindex, nofollow" />

<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style.css" />
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
<link rel="shortcut icon" href="/favicon.png" />

<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style-admin.css" />

</head>
<body>
<div id="logo">
<h1 id="header-sowka-logo"><a href="/"><?= $_CONFIG['admin-sitename'] ?></a></h1>
<div id="nav">
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);"  href="/">Komiks</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" href="/blog/">Blog</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" href="/comments/">Komentarze</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" href="/users/">Użytkownicy</a>
<a style="-ms-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -o-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -moz-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); -webkit-transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg); transform: rotate(<?=rand(-2,2);?>.<?=rand(0,99)?>deg);" href="/logout/">Wyloguj</a>
</div>
</div>
<div id="wrapper">
<? if ($_SOWKA['top']) { ?>
<div id="top">
<?= $_SOWKA['top'] ?>
</div>
<? } ?>
<div id="content">
<p>Nic tu jeszcze nie ma.</p>
