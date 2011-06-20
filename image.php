<?
$size = getimagesize($_GET['file']);
header('Content-type: '.$size['mime']);

$height = $_GET['width'] / ($size[0]/$size[1]);

if ($size[2]==1) {
  $obraz=imagecreatefromgif($_GET['file']);
}
elseif ($size[2]==2) {
  $obraz=imagecreatefromjpeg($_GET['file']);
}
elseif ($size[2]==3) {
  $obraz=imagecreatefrompng($_GET['file']);
}

$obraznowy=imagecreatetruecolor($_GET['width'],$height);
imagecopyresized($obraznowy,$obraz,0,0,0,0,$_GET['width'],$height,$size[0],$size[1]);

if ($size[2]==1) {
  imagegif($obraznowy);
}
elseif ($size[2]==2) {
  imagejpeg($obraznowy,80);
}
elseif ($size[2]==3) {
  imagepng($obraznowy);
}
