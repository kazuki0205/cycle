<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/product.css">
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
        <li><a href="">おしらせ</a></li>
        <li><a href="./upload.php">出品</a></li>
        <li><a href="./login.php"><?php echo isset($_SESSION['user_id']) ? '別アカウントでログイン':'ログイン';?></a></li>
        <li><a href="./order_history.php">注文履歴</a></li>
    </ul>
</header>
<main>

    <div class="left">
        <div class="mainLeft">
            <div class="itemImg">
                <img src="../img/<?php echo $list['id'];?>.<?php echo $list['ext'];?>">
            </div>
            <div class="user">
                <h2 class="human">出品者</h2>
                <div class="userItem">
                    <div class="userIcon">
                        <img src="../img/userImg/<?php echo $user['id'];?>.png">
                    </div>
                    <div class="userName">
                        <h2><?php echo $user['user_name'];?></h2>
                        <p>★★★★☆</p>
                        <p class="rev">本人確認済み</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mainRight">
            <div class="productTitle">
                <h2><?php echo $list['product_name']?></h2>
                <p class="genre"><?php echo $list['brand'] ?></p>
                <p class="price">¥<?php echo number_format($list['price']);?> <span>(税込)送料込み</span></p>
                <div class="buy"><a href="./buy.php?id=<?php echo $id; ?>">購入する</a></div>
            </div>
            <div class="productSummary">
                <h2 class="topic">商品の概要</h2>
                <p class="summaryComment"><?php echo $list['product_description']?></p>
                <p class="saleDate"><?php echo $list['exhibited_at']?></p>
            </div>
            <div class="detail">
                <h2 class="topic">商品の情報</h2>
                <table>
                    <tr>
                        <th>カテゴリ</th>
                        <td><a href="./search.php?category=<?php echo $list['category']?>"><?php echo $cate?></a> ></td>
                    </tr>
                    <tr>
                        <th>ブランド</th>
                        <td><a href="./search.php?brand=<?php echo $list['brand']?>"><?php echo $list['brand']?></a> ></td>
                    </tr>
                    <tr>
                        <th>商品の状態</th>
                        <td><?php echo $status;?></td>
                    </tr>
                    <tr>
                        <th>発送までの日時</th>
                        <td><?php echo $delivery_time?></td>
                    </tr>
                    <tr>
                        <th>発送元</th>
                        <td><?php echo $user['pref']?></td>
                    </tr>
                </table>
            </div>
            <div class="commentConte">
                <h2 class="topic">コメント(<?php echo $commentCount;?>)</h2>
                <div class="commentDiv">
                <div class="nonComment"><h2><?php echo $er_msg;?></h2></div>
                    <?php foreach($allComments as $row):?>
                    <div class="<?php echo $row['user_id'] == $user['id'] ? 'sellerComment' : 'buyerComment'; ?>"> 
                        <div class="icon"><img src="../img/userImg/<?php echo $row['user_id'];?>.png"></div>
                        <div class="commentItem">
                            <?php foreach($allusersNumName as $val):?>
                                <p><?php echo $val['id'] == $row['user_id'] ? $val['user_name']: '' ?></p>
                            <?php endforeach;?>
                            <p><?php echo $row['comment'];?></p>
                            <p class="comment_time"><?php echo $row['post_time']?></p>
                            <!-- <p><?php if(isset($allComments[0]['comment'])){echo $allComments[0]['comment'];}?></p> -->
                        </div>
                    </div>
                    <?php endforeach;?>

                    <div class="commentWrite">
                        <form action="" method="POST">
                            <div>
                                <p>商品へのコメント</p>
                                <textarea name="commentContent" cols="60" rows="5" placeholder="コメントする"></textarea>
                            </div>
                            <p>相手のことを考え丁寧なコメントを心がけましょう。
                            </p>
                            <button class="commentWriteButton" type="submit" name="commentSubmit" value="insert">コメントする</button>
                        </form>
                    </div>
                </div>
            </div>
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
</body>
</html>