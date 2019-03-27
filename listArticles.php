<?php require 'header.php'; ?>
<?php require 'functions.php'; ?>
<?php require_once 'connection.php'; ?>
<?php

$pdo = new PDO(DSN, USER, PASS);
$articles = getAllArticles($pdo);

?>

<div class="container">
  <h1>Liste des articles</h1>
  <hr/>
  
  <?php
  foreach($articles as $article) {
    include('article.php');
  }
  ?>

  <a href="addArticle.php">Ajouter un article</a>
</div>

<?php require 'footer.php'; ?>