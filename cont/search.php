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
$search_data = '';
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
//検索機能
// 検索ボタン押されたら
if(isset($_POST['set']) && $_POST['set'] == 'complete'){
    $serch = $_POST['serch'];
    $search_data = $_POST['serch'];
    //一覧表示
    // require_once('../../config.php');
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM products WHERE brand like '%". $serch ."%' OR product_name like '%". $serch ."%' OR product_description like '%". $serch ."%';";
    // echo $SELECT;
    $result = mysqli_query($link,$SELECT);
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $list[$i] = $row;
        $i++;
        }
    mysqli_close($link);
    require_once('../view/search.php');
}
elseif(isset($_GET['brand'])){
    //ブランド検索
    $brand = $_GET['brand'];
    $search_data = $_GET['brand'];
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM products WHERE brand = '".$brand."';";
    // echo $SELECT;
    $result = mysqli_query($link,$SELECT);
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $list[$i] = $row;
        $i++;
        }
    mysqli_close($link);

}
elseif(isset($_GET['category'])){
    //カテゴリ検索
    $category = $_GET['category']; 
    if($category == '0'){
        $search_data = 'ファッション';
    }
    elseif($category == '1'){
        $search_data = 'インテリア';
    }
    elseif($category == '2'){
        $search_data = 'おもちゃ、ゲーム';
    }
    elseif($category == '3'){
        $search_data = '調理器具';
    }
    elseif($category == '4'){
        $search_data = '赤ちゃん雑貨';
    }
    elseif($category == '5'){
        $search_data = 'ハンドメイド';
    }
    elseif($category == '6'){
        $search_data = '本';
    }
    elseif($category == '7'){
        $search_data = 'コスメ、香水、美容';
    }
    elseif($category == '8'){
        $search_data = 'その他';
    }
    // echo $search_data;
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM products WHERE category = '".$category."';";
    // echo $SELECT;
    $result = mysqli_query($link,$SELECT);
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $list[$i] = $row;
        $i++;
        }
    mysqli_close($link);
}

// 検索件数問題
if(isset($list)){
    $score = 0;
    foreach($list as $val){
        $score++;
    }    
}
require_once('../view/search.php');
?>