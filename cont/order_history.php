<?php
session_start();
// $user_id = $_SESSION['user_id'];
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

//購入履歴取得
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT * FROM purchase_histories WHERE user_id = $user_id;";
$result = mysqli_query($link,$SELECT);
while($row = mysqli_fetch_assoc($result)){
    $buyList[] = $row['product_id'];
    }
mysqli_close($link);
// var_dump($list);
//一覧表示
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
if(isset($buyList)){
    $SELECT = "SELECT * FROM products WHERE id in (".implode(",",$buyList). ");";
    // echo $SELECT;
    $result = mysqli_query($link,$SELECT);
    $i = 0;
while($row = mysqli_fetch_assoc($result)){
    $list[$i] = $row;
    $i++;
    }
}

mysqli_close($link);

if(isset($list)){
    $score = 0;
    foreach($list as $val){
        $score++;
    }    
}

require_once('../view/order_history.php');
?>
