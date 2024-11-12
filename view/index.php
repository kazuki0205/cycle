<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
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
        <li><a href=""><?php echo isset($nameList['user_name']) ? $nameList['user_name']:'新規登録';?></a></li>
        <li><a href=""><span>おしらせ</span></a></li>
        <li><a href="./upload.php"><span>出品</span></a></li>
        <li><a href="./login.php"><span><?php echo isset($_SESSION['user_id']) ? '別アカウントでログイン':'ログイン';?></span></a></li>
        <li><a href="./order_history.php"><span>注文履歴</span></a></li>
    </ul>
</header>
<main>
<div class="top">
        <div class="sicle"><img src="../img/sicle.png"></div>
        <div class="en"><img src="../img/en.png"></div>
        <div class="copy"><img src="../img/copy.png"></div>
</div>

<div class="left">
    <div class="leftConte">
        <div class="osusume"><a href="./index.php">おすすめ</a></div>
        <div class="watch"><a href="./indexWatch.php">ピックアップ</a></div>
        <h1><img src="../img/hero.png" alt=""></h1>

        <h2 class="err_pick"><?php echo empty($list) ? 'ピックアップはございません。': '';?></h2>
        <?php foreach($list as $val){ ?>
        <div class="Item">
            <a href="./product.php?id=<?php echo $val['id'];?>">
            <div class="ItemImgDiv">
                <img src="../img/<?php echo $val['id'];?>.<?php echo $val['ext'];?>">
                <div class="soldOut" style="<?php echo $val['purchased_flag'] == 1 ? 'display : block' : 'display : none'; ?>">SOLD OUT</div>
            </div>
            <h2><?php echo $val['product_name'];?></h2>
            <div class="price"><p>¥<?php echo number_format($val['price']);?></p></div> 
            </a>
        </div>
        <?php } ?>

    </div>

</div>
<div class="right">
    <div>
        <h2>カテゴリ一覧</h2>
        <hr>
        <ul>
            <li><a href="./search.php?category=0">ファッション</a></li>
            <li><a href="./search.php?category=1">美容</a></li>
            <li><a href="./search.php?category=2">おもちゃゲーム</a></li>
            <li><a href="./search.php?category=3">調理器具</a></li>
            <li><a href="./search.php?category=4">赤ちゃん雑貨</a></li>
            <li><a href="./search.php?category=5">ハンドメイド</a></li>
            <li><a href="./search.php?category=6">本</a></li>
            <li><a href="./search.php?category=7">コスメ｜香水</a></li>
            <li><a href="./search.php?category=8">その他</a></li>
        </ul>
    </div>
    <div>
        <h2>人気ブランド10</h2>
        <hr>
        <ul>
        <?php foreach($brandList as $val){ ?>
            <li><a href="./search.php?brand=<?php echo  $val; ?>"><?php echo  $val; ?></a></li>
        <?php } ?>
        </ul>
    </div>
    

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
<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../js/script.js"></script>
</body>
</html>