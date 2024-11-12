<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/buy.css">
    <title>Document</title>
</head>
<body>
<header>
    <h1><a href="./index.php"><img src="../img/logo.png" alt=""></a></h1>
    <form action="./search.php" method="POST">
    <input type="text" name="serch" placeholder="何をお探しですか？">
    <button type="submit" name="set" value="complete"><img src="../img/search-outline.svg"></button>
    </form>
    <ul>
        <li><?php echo isset($nameList['user_name']) ? $nameList['user_name']:'';?></li>
        <li>おしらせ</li>
        <li><a href="./upload.php">出品</a></li>
        <li><a href="./login.php"><?php echo isset($_SESSION['user_id']) ? '別アカウントでログイン':'ログイン';?></a></li>
        <li><a href="./order_history.php">注文履歴</a></li>
    </ul>
</header>
<main>
    <div class="buyWrap">
        <div class="price">
            <h2>購入金額</h2>
            <p>¥<?php echo $list['price'];?></p>
        </div>
        <form action="./buy.php" method="POST">
            <?php echo isset($ans['pay_method']) ? $ans['pay_method']:'';?>
            <?php echo isset($ans['card']) ? $ans['card']:'';?>
                <div class="statusContent">
                    <p>お支払い方法を選択ください</p>
                    <select name="pay_method" id="">
                        <option disabled selected value>選択してください</option>
                        <option value="0">コンビニ支払い</option>
                        <option value="1">銀行振り込み</option>
                        <option value="2">クレジットカード</option>
                    </select>
                </div>
                <div id="card">
                    <div class="cardDisc">
                        <p>クレジットカードでお支払いの場合</p>
                        <p>ご登録のカードをお選びください</p>
                    </div>
                    <input type="radio" id="have" name="card" value="0">
                    <label for="have" class="have">
                        <div>
                            <p>氏名 <?php echo $cardList['first_name'] ?></p>
                            <p>下四桁<?php echo $num; ?></p>
                            <p>有効日時<?php echo $cardList['card_date']; ?></p>
                        </div>
                    </label>
                    <div class="cardRegister"><a href="./cardRegister.php"><p>新規カード登録</p></a></div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <button type="submit" name="set" value="complete" class="buyButton">購入</button>
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
<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>