<!--
  Luodaan hakukenttä rajaamaan taulukon presidenttejä. 
  Sivustoa hyödynnetään index.php tiedostossa.
-->
<div class="container">
<h3 class="my-3">Hae presidenttejä.</h3>
  <form action="index.php" method="get">
    <input type="hidden" name="page" value="search_president">
    <div class="row">
      <div class="col-md-2">
        <input type="text" class="form-control mb-2" placeholder="Hakusana" name="hakusana">
        <input type="submit" class="btn btn-primary" value="Hae">
      </div>
    </div>
  </form>
</div>

<?php
  require 'kaikkiPresidentit.php';
?>