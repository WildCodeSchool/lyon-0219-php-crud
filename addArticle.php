<?php require 'header.php'; ?>
<?php require 'functions.php'; ?>
<?php require_once 'connection.php'; ?>
<?php

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pdo = new PDO(DSN, USER, PASS);
  $title = $_POST['title'];
  $content = $_POST['content'];
  $author = $_POST['author'];
  $errors = isArticleValid($title, $content, $author);
  if (empty($errors)) {
    createArticle($pdo, $title, $content, $author);
    header('Location: listArticles.php');
    exit;
  }
}
?>

<div class="container">
  <form class="form-group" method="POST">
    <label for="title">Titre</label>
    <input class="form-control" id="title" type="text" name="title" />
    <?= $errors['title'] ?>
    <br/>

    <label for="content">Contenu</label>
    <textarea class="form-control" id="content" name="content" rows="10"></textarea>
    <?= $errors['content'] ?>
    <br/>

    <label for="author">Auteur</label>
    <select id="author" name="author">
      <option value="" disabled>Sélectionner un auteur</option>
      <option value="ludo">Le patron</option>
      <option value="jd">L'ancien</option>
      <option value="mael">Le traître</option>
    </select>
    <?= $errors['author'] ?>

    <br/>
    <input class="btn btn-warning" type="submit" value="Let's go Pikachu"/>
  </form>
</div>

<?php require 'footer.php'; ?>