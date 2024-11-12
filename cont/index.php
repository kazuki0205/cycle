<?php
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
require_once('../../config.php');
$link = @mysqli_connect('localhost','root','root','IH23');
mysqli_set_charset($link,'utf8');
$SELECT = "SELECT * FROM products ORDER BY id DESC;";
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

require_once('../view/index.php');
?>