<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../css/upload.css">
    <title>さいくる｜出品する</title>
    <!-- googlefont -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <!-- icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 

</head>
<body>
    <!-- hedaer element -->
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

    <!-- main element -->
    <main>
        <div id="uploadContainer">
            <h2 class="title">商品の出品</h2>
            <form action="./upload.php" method="post" enctype="multipart/form-data">
                <!-- uploading Image section -->
                <h3>出品画像</h3>
                <div class="imageContentArea">
                    <p>画像を選択する</p>
                    <p>または ドラッグ&ドロップ</p>
                    <input type="file" name="imageData" id="input-files">
                </div>
                
                <!-- product detail section -->
                <h3>商品の詳細</h3>
                <div class="detailContent">
                    <p>カテゴリー</p>
                    <select name="categories" id="">
                        <option disabled selected value>選択してください</option>
                        <option value="0">ファッション</option>
                        <option value="1">インテリア</option>
                        <option value="2">おもちゃ、ゲーム</option>
                        <option value="3">調理器具</option>
                        <option value="4">赤ちゃん雑貨</option>
                        <option value="5">ハンドメイド</option>
                        <option value="6">本</option>
                        <option value="7">コスメ、香水、美容</option>
                        <option value="8">その他</option>
                    </select>
                </div>

                <div class="brandContent">
                    <p>ブランド</p>
                    <input type="text" name="brand" placeholder="例）ユニクロ">
                </div>

                <div class="statusContent">
                    <p>商品の状態</p>
                    <select name="states" id="">
                        <option disabled selected value>選択してください</option>
                        <option value="0">新品</option>
                        <option value="1">ほぼ新品</option>
                        <option value="2">中古</option>
                    </select>
                </div>
                
                <!-- product name & description -->
                <h3>商品名と説明</h3>
                <div class="productName">
                    <p>商品名</p>
                    <input type="text" name="productName" placeholder="例）ジャケット">
                </div>

                <div class="productDescription">
                    <p>商品の説明</p>
                    <textarea name="productDescription" id="" cols="60" rows="5" placeholder="色、素材、重さ、定価、注意点など

例）2010年ごろに2万円で購入したジャケットです。傷はありません。合わせやすいのでおすすめです！"></textarea>
                </div>

                <div class="deliveryTime">
                    <p>配送日時</p>
                        <select name="delivery_time" id="">
                            <option disabled selected value>選択してください</option>
                            <option value="0">1~2日</option>
                            <option value="1">3~5日</option>
                            <option value="2">6~7日</option>
                        </select>

                </div>

                <div class="price">
                    <p>販売価格</p>
                    <input type="text" name="price" placeholder="¥">
                </div>

                <!-- submit button -->
                <div class="submit">
                <button type="submit" name="set" value="complete">出品</button>
                </div>
            </form>
        </div>
    </main>

    <!-- footer element -->
    <footer>
        <ul>
            <li>さいくるについて</li>
            <li>ヘルプセンター</li>
            <li>プライバシーと利用規約</li>
        </ul>
        <p class="logoFooter">さいくる</p>
        <p class="copy">Copyright © 2022 MASARUDO Inc. All Rights Reserved.</p>
    </footer>

    <!-- js -->
    <script src="./js/script.js"></script>
</body>
</html>