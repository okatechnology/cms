<?php
  require_once('convertAuthority.php');

  session_start();

  if (!$_SESSION['user']) {
    header('Location: index.php');
    exit();
  }

  $authority = $_SESSION['authority'];
  if (convertAuthority($authority)[1] != 1) {
    header('Location: index.php');
    exit();
  }

  $targetID = $_GET['id'];

  try{
    $dbh = new PDO(
      'mysql:host=db;dbname=webproLastAssignmentdb',
      'user',
      'password'
    );
    $stmt = $dbh->prepare(
      "select contents.title, contents.mainContents from contents where contents.id = ?;"
    );
    $stmt->execute([$targetID]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $contents = $row['mainContents'];

    $stmt = $dbh->prepare(
      'select * from categories;'
    );
    $stmt->execute();

    while($rowOfCategories = $stmt->fetch(PDO::FETCH_ASSOC)){
      $selectCategoryHTML .= "
        <option value='{$rowOfCategories["id"]}'>{$rowOfCategories['name']}</option>
      ";
    }

?>

<!DOCTYPE html>
<html lang="ja-JP">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <title>コンテンツ編集</title>
</head>
<body>
  <div class="wrapper">
    <?php require_once('header.php'); ?>
    <div class="mainAndAsideWrapper">
      <?php require_once('sideBar.php'); ?>
      <main class="main">
        <h1 class="main__pageTitle">コンテンツ編集</h1>
        <form class="form" action="editContentsProcess.php" method="post">
          <label class="form__label" for="category">カテゴリ</label>
          <select class="form__select" name="category" id="category">
            <?= $selectCategoryHTML ?>
          </select>
          <label class="form__label" for="title">タイトル</label>
          <input class="form__text" type="text" name="title" id="title" value="<?= $title ?>">
          <label class="form__label" for="contents">内容</label>
          <textarea class="form__textarea" name="contents" id="contents"><?= $contents ?></textarea>
          <input type="text" name="id" value="<?= $targetID ?>" hidden>
          <input class="form__button" type="submit" value="登録">
        </form>
      </main>
    </div>
    <?php require_once('footer.php'); ?>
  </div>
</body>
</html>

<?php
  } catch (PDOException $e) {
    var_dump($e);
  }
