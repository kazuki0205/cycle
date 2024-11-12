<?php
//一覧表示
session_start();
require_once('../../config.php');
//ユーザーネーム取得
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM users WHERE id = $user_id ORDER BY id DESC;";
    $result = mysqli_query($link,$SELECT);
    while($row = mysqli_fetch_assoc($result)){
        $nameList['user_name'] = $row['user_name'];
        }
    mysqli_close($link);
}

// $user_id = $_SESSION['user_id'];
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT DISTINCT product_id FROM watch_histories WHERE user_id = '". $user_id."'";
$result = mysqli_query($link,$SELECT);
// var_dump($SELECT);
while($row = mysqli_fetch_assoc($result)){
    $watchList[] = $row['product_id'];
    }
mysqli_close($link);
// var_dump($watchList);
// echo implode(",",$watchList)

if(!isset($watchList)){
    $watchList = [];
}

$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT * FROM products WHERE id in (".implode(",",$watchList). ") ORDER BY id DESC;";
// echo $SELECT;
$result = mysqli_query($link,$SELECT);
$i = 0;
while($row = mysqli_fetch_assoc($result)){
    $list[$i] = $row;
    $i++;
    }
mysqli_close($link);
// var_dump($list);

//人気ブランド表示
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT DISTINCT brand FROM products LIMIT 10;";
$result = mysqli_query($link,$SELECT);

while($row = mysqli_fetch_assoc($result)){
    $brandList[] = $row['brand'];
    }
mysqli_close($link);
// var_dump($watchList);

if(!isset($list)){
    $list = [];
}
require_once('../view/index.php');
?>