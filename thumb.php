<?
include_once('includes/functions.php');

if (!file_exists($_GET['file'])) {
  header('Location: '.$_CONFIG['siteurl'].$_GET['file']);
  die();
}

if ($_GET['width']>2000) {
  echo "Too big.";
  die();
}

$size = getimagesize($_GET['file']);
//header('Content-type: '.$size['mime']);

$height = $_GET['width'] / ($size[0]/$size[1]);

if ($size[2]==1) {
  $ext = '.gif';
}
elseif ($size[2]==2) {
  $ext = '.jpg';
}
elseif ($size[2]==3) {
  $ext = '.png';
}

if (file_exists("thumbnails/".md5($_GET['file'].".".$_GET['width']).$ext)) {
header('Location: '.$_CONFIG['siteurl'].'thumbnails/'.md5($_GET['file'].".".$_GET['width']).$ext);
die();
}

if ($size[2]==1) {
  $obraz=imagecreatefromgif($_GET['file']);
}
elseif ($size[2]==2) {
  $obraz=imagecreatefromjpeg($_GET['file']);
}
elseif ($size[2]==3) {
  $obraz=imagecreatefrompng($_GET['file']);
}
else {
  die("Bad boy/girl!");
}

$obraznowy=imagecreatetruecolor($_GET['width'],$height);
imageinterlace($obraznowy, true);
imagealphablending($obraznowy, false);
imagesavealpha($obraznowy, true);
imagecopyresized($obraznowy,$obraz,0,0,0,0,$_GET['width'],$height,$size[0],$size[1]);

if ($size[2]==1) {
  imagegif($obraznowy,"thumbnails/".md5($_GET['file'].".".$_GET['width']).$ext);
}
elseif ($size[2]==2) {
  imagejpeg($obraznowy,"thumbnails/".md5($_GET['file'].".".$_GET['width']).$ext,80);
}
elseif ($size[2]==3) {
  imagepng($obraznowy,"thumbnails/".md5($_GET['file'].".".$_GET['width']).$ext);
}

header('Location: '.$_CONFIG['siteurl'].'thumbnails/'.md5($_GET['file'].".".$_GET['width']).$ext);
