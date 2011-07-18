<?
$_THEME['width'] = 786;
$facebook_enable = true;
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
<meta property="og:title" content="<? echo $_CONFIG['sitename']; if ($page_title) { echo ' - '.$page_title; } ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<? if ($page_permalink) { echo $page_permalink; } else { echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; }; ?>" />
<meta property="og:image" content="<? if ($page_image) { echo $page_image; } else { echo $_CONFIG['siteurl'].$_CONFIG['comics_path'].'logo.png'; } ?>" />
<meta property="og:site_name" content="<?= $_CONFIG['sitename'] ?>" />
<meta property="fb:admins" content="<?= $_CONFIG['fb']['admins'] ?>" />

<meta name="description" content="Komiks internetowy o Sówce mieszkającej na drzewie w ogródku u Pana Człowieka." />
<meta name="keywords" content="sówka,sowa,sowy,komiks,comic,webcomic,drzewo,ptak,ptaki,humor,rysunek" />
<meta name="author" content="Agata Kurczewska" />
<meta name="content-title" content="Sówka" />
<meta name="content-language" content="pl" />
<meta name="robots" content="index, follow" />
<link rel="index" title="Sówka" href="/" />
<link rel="alternate" type="application/rss+xml" title="Sówka - Komiks" href="/rss/" />

<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/style.css" />
<link rel="stylesheet" href="/themes/<?= $_CONFIG['theme'] ?>/psuja.css" />
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

</head>
<body>
<div id="logo">
<h1 id="header-sowka-logo"><a href="/"><?= $_CONFIG['sitename'] ?></a></h1>
</div>
<div id="wrapper">
<? if ($_SOWKA['top']) { ?>
<div id="top">
<?= $_SOWKA['top'] ?>
</div>
<? } ?>
<div id="content">
