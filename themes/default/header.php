<?
$_THEME['width'] = 600;
?>
<? /*echo '<?xml version="1.0" encoding="utf-8"?>';
   echo '<?xml-stylesheet type="text/css" href="/themes/default/style.css"?>';*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta property="og:title" content="<? echo $_CONFIG['sitename']; if ($page_title) { echo ' - '.$page_title; } ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<? if ($page_permalink) { echo $page_permalink; } else { echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; }; ?>" />
<meta property="og:image" content="<?= $page_image ?>" />
<meta property="og:site_name" content="<?= $_CONFIG['sitename'] ?>" />
<meta property="fb:admins" content="<?= $_CONFIG['fb']['admins'] ?>" />
<link rel="stylesheet" href="/themes/default/style.css" />
<meta charset="utf-8" />
<title><?= $_CONFIG['sitename'] ?><? if ($page_title) { echo " - ".$page_title; } ?></title>
</head>
<body>
<div id="wrapper">
<h1><a href="/"><?= $_CONFIG['sitename'] ?></a></h1>
<div id="nav"><a href="/archive">archive</a> | <a href="/blog">blog</a> | <a href="/about">about</a> | <a href="/login">login</a></div>
