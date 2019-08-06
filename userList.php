<?php
  require_once('convertAuthority.php');
  require_once('showAuthority.php');

  session_start();

  if (!$_SESSION['user']) {
    header('Location: index.php');
    exit();
  }

  $authority = $_SESSION['authority'];
  if (convertAuthority($authority)[2] != 1) {
    header('Location: index.php');
    exit();
  }

  try{
    $dbh = new PDO(
      'mysql:host=db;dbname=webproLastAssignmentdb',
      'user',
      'password'
    );

    $stmt = $dbh->prepare('select * from userInfo');
    $stmt->execute();

    while($rowOfUserInfo = $stmt->fetch(PDO::FETCH_ASSOC)){
      $authorityString = showAuthority($rowOfUserInfo['authority']);
      $userInfoHTML .= "
        <li class='list__row'>
          <ul class='row'>
            <li class='row__item--thin'>{$rowOfUserInfo['id']}</li>
            <li class='row__item'>{$rowOfUserInfo['name']}</li>
            <li class='row__item'>{$authorityString}</li>
          </ul>
        </li>
      ";
    }
?>

<!DOCTYPE html>
<html lang="ja-JP">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <title>ユーザー一覧</title>
</head>
<body>
  <div class="wrapper">
    <?php require_once('header.php'); ?>
    <div class="mainAndAsideWrapper">
      <?php require_once('sideBar.php'); ?>
      <main class="main">
        <h1 class="main__pageTitle">ユーザ</h1>
        <a class="main__addButton" href="addUser.php">新規登録</a>
        <ul class="list">
          <li class="list__row">
            <ul class="row">
              <li class="row__item--title--thin">ID</li>
              <li class="row__item--title">User</li>
              <li class="row__item--title">権限</li>
            </ul>
          </li>
          <?= $userInfoHTML ?>
        </ul>
      </main>
    </div>
    <?php require_once('footer.php'); ?>
  </div>
</body>
</html>

<?php 
  } catch (PDOException $e) {
  var_dump($e);
  exit;
  }

