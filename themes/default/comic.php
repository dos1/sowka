<?include('header.php');?>

<div><?= $comic['id'] ?>. <?= $comic['name'] ?></div>
<img src="<?= $comic['src'] ?>" alt="<?= $comic['alt'] ?>" title="<?= $comic['alt'] ?>" />
<p><?= $comic['comment'] ?></p>

<hr />

<p>Komcie: </p>
<div><?= $page_comments ?></div>

<?include('footer.php');?>
