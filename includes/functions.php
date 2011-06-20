<?
require('conf/config.php');
$baza = mysql_connect ($_CONFIG['mysql_host'], $_CONFIG['mysql_user'], $_CONFIG['mysql_pass']) or die('Nie można połączyć się z bazą danych ponieważ: ' . mysql_error());

mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8_polish_ci");

mysql_select_db ($_CONFIG['mysql_db']);


function facebook_init() {
?>
<div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({appId: '131905576888350', status: true, cookie: true,
                 xfbml: true});
      };
      (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/pl_PL/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
<? }
