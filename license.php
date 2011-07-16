<?
include_once('includes/functions.php');

$about['title']='Licencja';
$about['content']='<p>Komiks "Sówka" udostępniany jest na zasadach licencji <a href="http://creativecommons.org/licenses/by-sa/3.0/pl/">CC-BY-SA 3.0 PL</a>.</p> <p>Oznacza to, że możesz do woli wykorzystywać paski i grafiki w swoich projektach, rozpowszechniać je dalej itp. pod dwoma warunkami:</p><ul><li>uznanie autorstwa (polegające na tym, że nie wolno Ci przypisać sobie naszej pracy, a gdy ją wykorzystujesz, musisz wskazać oryginalnych autorów)</li><li>na tych samych warunkach (prace, w których wykorzystane zostały nasze, muszą być opublikowane na tej samej, lub zgodnej, licencji)</li></ul><p>Szczegółowe informacje na temat licencji CC-BY-SA 3.0 PL dostępne są na stronie <a href="http://creativecommons.org/licenses/by-sa/3.0/pl/">Creative&nbsp;Commons</a>.</p>';
//$about['content'].='<p>Kod strony dostępny jest na licencji <a href="http://www.gnu.org/licenses/agpl.html">GNU AGPLv3+</a>.</p>';

include_once('themes/'.$_CONFIG['theme'].'/about.php');
