<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Document</title>
</head>
<body>
<header>
    <h1><a href="./index.php"><img src="../img/logo.png" alt=""></a></h1>
    <form action="./search.php" method="POST">
    <input type="text" name="serch" placeholder="何をお探しですか？">
    <button type="submit" name="set" value="complete"><img src="../img/search-outline.svg"></button>
    </form>
    <ul class="gnavi">
        <li><a href=""><?php echo isset($nameList['user_name']) ? $nameList['user_name']:'';?></a></li>
        <li><a href=""><span>おしらせ</span></a></li>
        <li><a href="./upload.php"><span>出品</span></a></li>
        <li><a href="./login.php"><span><?php echo isset($_SESSION['user_id']) ? '別アカウントでログイン':'ログイン';?></span></a></li>
        <li><a href="./order_history.php"><span>注文履歴</span></a></li>
    </ul>
</header>
<main>
    <div class="loginWrap">
    <?php echo isset($ans['mail']) ? $ans['mail']:'';?>
    <?php echo isset($ans['pass']) ? $ans['pass']:'';?>
    <?php echo isset($ans['error']) ? $ans['error']:'';?>
    <form action="./login.php" method="post" enctype="multipart/form-data">
        <p>ご登録されたメールアドレス</p>
        <input type="text" name="mail" placeholder="example@example.com">
        <p>パスワード</p>
        <input type="text" name="pass" placeholder="">
        <button type="submit" name="set" value="complete">ログイン</button>
    </form>
    </div>
</main>
<footer>
    <ul>
        <li>さいくるについて</li>
        <li>ヘルプセンター</li>
        <li>プライバシーと利用規約</li>
    </ul>
    <p class="logoFooter">さいくる</p>
    <p class="copy">Copyright © 2022 MASARUDO Inc. All Rights Reserved.</p>
</footer>
</body>
</html>