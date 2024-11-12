<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/order_history.css">
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
    <div class="searchTxt">
        <h1><?php echo isset($nameList['user_name']) ? $nameList['user_name']:'';?> さんの注文履歴</h1>
        <p><?php echo isset($score) ? $score : '0';?>件</p>
    </div>
<div class="historyWrap">

<?php if(isset($list)){?>
        <?php foreach($list as $val){ ?>
        <div class="Item">
            <a href="./product.php?id=<?php echo $val['id'];?>">
            <div class="ItemImgDiv">
                <img src="../img/<?php echo $val['id'];?>.<?php echo $val['ext'];?>">
                <div class="soldOut" style="<?php echo $val['purchased_flag'] == 1 ? 'display : block' : 'display : none'; ?>">YOU BOUGHT IT</div>
            </div>
            <h2><?php echo $val['product_name'];?></h2>
            <div class="price"><p>¥<?php echo number_format($val['price']);?></p></div> 
            </a>
        </div>
        <?php }}else{ ?>
            <div class="Item">
            <h2>購入履歴がございません。</h2>
            </div>
        <?php } ?>
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