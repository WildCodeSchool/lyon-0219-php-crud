<?php
/**
 * Retourne un tableau contenu les messages d'erreurs si le titre, *
 * le contenu et l'auteur
 * sont renseignés s'ils ont le bon nombre de caractères.
 * @param  string  $title   titre
 * @param  string  $content contenu
 * @param  string  $author  l'auteur
 * @return array   le tableau d'erreur         
 */
function isArticleValid($title, $content, $author) {
  $errors = [];
  // Si le title existe et si il est vide
  if (isset($title) && (empty($title) || strlen($title) > 50)) {
    $errors['title'] = "Le titre n'est pas valide";
  }

  if (isset($content) && empty($content)) {
    $errors['content'] = "Le contenu est vide";
  } 

  if (isset($author) && (empty($author) || strlen($author) > 30)) {
    $errors['author'] = "L'auteur n'est pas valide";
  }

  return $errors;
}

/**
 * Ajoute un article dans la base de données.
 * @param  PDO $pdo     connexion à la base de données
 * @param  string $title   title
 * @param  string $content contenu
 * @param  string $author  l'auteur
 */
function createArticle($pdo, $title, $content, $author) {
  $insert = "INSERT INTO articles (title, content, author) VALUES (:title, :content, :author);";

  $prep = $pdo->prepare($insert);
  $prep->bindValue(':title', $title, PDO::PARAM_STR);
  $prep->bindValue(':content', $content, PDO::PARAM_STR);
  $prep->bindValue(':author', $author, PDO::PARAM_STR);

  $prep->execute();
}

/**
 * Retourne tous les articles de la table article.
 * @param  PDO $pdo connexion à la base de données
 * @return array      tableau des articles
 */
function getAllArticles($pdo) {
  $select = "SELECT * FROM articles;";

  $res = $pdo->query($select);
  $articles = $res->fetchAll(PDO::FETCH_ASSOC);

  return $articles;
}