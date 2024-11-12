<?php
require_once('../../config.php');
session_start();
//ユーザーネーム取得
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM users WHERE id = $user_id;";
    $result = mysqli_query($link,$SELECT);
    while($row = mysqli_fetch_assoc($result)){
        $nameList['user_name'] = $row['user_name'];
        }
    mysqli_close($link);
}


//一覧表示
$id = $_GET['id'];
// $user_id = $S;
// $_SESSION['id'] = $_GET['id'];
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT * FROM products WHERE id = $id;";
$result = mysqli_query($link,$SELECT);
while($row = mysqli_fetch_assoc($result)){
    $list = $row;
    }
mysqli_close($link);
// var_dump($list);


//人気ブランド表示
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT DISTINCT brand FROM products  LIMIT 10;";
$result = mysqli_query($link,$SELECT);

while($row = mysqli_fetch_assoc($result)){
    $brandList[] = $row['brand'];
    }
mysqli_close($link);
// var_dump($watchList);

// 出品者情報
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT * FROM users WHERE id = '".$list['user_id']."';";
$result = mysqli_query($link,$SELECT);
while($row = mysqli_fetch_assoc($result)){
    $user = $row;
    }
mysqli_close($link);
// var_dump($user);
// echo "<br><br><br><br><br><br><br><br>";


//ウォッチリスト登録処理
//データベース接続
$link = @mysqli_connect('localhost','root','root','IH23');
// //文字コード設定
mysqli_set_charset($link,'utf8');
//sql実行
$SQL = "INSERT INTO watch_histories(user_id,product_id) VALUES (" . $user_id . ",".$id.");";
// echo $SQL;
mysqli_query($link,$SQL);
mysqli_close($link);

// コメント関連
if(isset($_POST['commentSubmit']) && $_POST['commentSubmit'] == 'insert'){
    $er_msg = "";
    // コメント投稿
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SQL = "INSERT INTO comments(user_id,product_id,comment) VALUES ('".$user_id."','".$id."','".$_POST['commentContent']."');";
    // echo $SQL;
    mysqli_query($link,$SQL);
    mysqli_close($link);

    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT id,user_id,product_id,comment,post_time FROM comments WHERE product_id = '".$id."';";
    // echo $SELECT . "<br>";
    $resultComment = mysqli_query($link,$SELECT);
    while($row = mysqli_fetch_assoc($resultComment)){
        $allComments[] = $row;
    }
    mysqli_close($link);
    // var_dump($allComments);

    // コメントの()を増やす
    $commentCount = 0;  
        foreach($allComments as $row){
            $commentCount++;
        } 

    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $update = "UPDATE products SET comments = '".$commentCount."' WHERE id = '".$id."';";
    mysqli_query($link,$update);
    mysqli_close($link);
    
    // ユーザー情報
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT id, user_name FROM users;";
    $result = mysqli_query($link,$SELECT);
    while($row = mysqli_fetch_assoc($result)){
        $allusersNumName[] = $row;
    }
    mysqli_close($link);

    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM comments WHERE product_id = '".$id."';";
    $resultComment = '';
    $resultComment = mysqli_query($link,$SELECT);
    $allComments = '';
    $allComments = [];
    while($row = mysqli_fetch_assoc($resultComment)){
        $allComments[] = $row;
    }
    mysqli_close($link);

    // var_dump($allusersNumName);

}
//ページに飛んで最初の画面
else{ 
    // コメント情報をDBに登録後にviewに表示するためのコメントを読み込む
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM comments WHERE product_id = '".$id."';";
    // echo $SELECT . "<br>";
    $resultComment = mysqli_query($link,$SELECT);
    // エラーメッセージのリセット
    $er_msg = "";

    // コメント全件取得
    while($row = mysqli_fetch_assoc($resultComment)){
        $allComments[] = $row;
    }
    mysqli_close($link);

    // コメントの有無の設定
    if(empty($allComments)){
        $er_msg= "コメントがありません。";
        $allComments = '';
        $allComments = [];
        $allusersNumName = '';
        $allusersNumName = [];
    }
    
    // コメント数の設定
    $commentCount = 0;  
    if(!empty($allComments)){
        foreach($allComments as $row){
            $commentCount++;
        } 
    }
    // echo "<pre>";
    // var_dump($allComments);
    // echo "</pre>";
    // echo $commentCount;
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $update = "UPDATE products SET comments = '".$commentCount."' WHERE id = '".$id."';";
    mysqli_query($link,$update);
    mysqli_close($link);
    
    // ユーザー情報
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT id, user_name FROM users;";
    $result = mysqli_query($link,$SELECT);
    while($row = mysqli_fetch_assoc($result)){
        $allusersNumName[] = $row;
    }
    mysqli_close($link);
    // var_dump($allusersNumName);
    

    // コメントユーザー識別
}   

//カテゴリ
if($list['category'] == '0'){
    $cate = 'ファッション';
}
elseif($list['category'] == '1'){
    $cate = 'インテリア';
}
elseif($list['category'] == '2'){
    $cate = 'おもちゃ、ゲーム';
}
elseif($list['category'] == '3'){
    $cate = '調理器具';
}
elseif($list['category'] == '4'){
    $cate = '赤ちゃん雑貨';
}
elseif($list['category'] == '5'){
    $cate = 'ハンドメイド';
}
elseif($list['category'] == '6'){
    $cate = '本';
}
elseif($list['category'] == '7'){
    $cate = 'コスメ、香水、美容';
}
elseif($list['category'] == '8'){
    $cate = 'その他';
}
//ブランド
if(isset($list['brand'])){
    $bland = $list['brand'];
}
//商品状態
if($list['status'] == '0'){
    $status = '新品';
}
elseif($list['status'] == '1'){
    $status = 'ほぼ新品';
}
elseif($list['status'] == '2'){
    $status = '中古';
}

//発送までの日にち
if($list['delivery_time'] == '0'){
    $delivery_time = '1~2日';
}
elseif($list['delivery_time'] == '1'){
    $delivery_time = '3~5日';
}
elseif($list['delivery_time'] == '2'){
    $delivery_time = '6~7日';
}

//
// echo $list['brand'];
require_once('../view/product.php');
?>