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
if(isset($_GET['id'])){
    //商品をとってくる
    $id = $_GET['id'];
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM products WHERE id = $id;";
    $result = mysqli_query($link,$SELECT);
    while($row = mysqli_fetch_assoc($result)){
        $list = $row;
        }
    mysqli_close($link);
    // クレカ情報引き出し
    $user_id = $_SESSION['user_id'];
    $link = @mysqli_connect('localhost','root','root','IH23');
    mysqli_set_charset($link,'utf8');
    $SELECT = "SELECT * FROM card_info WHERE user_id = $user_id;";
    $result = mysqli_query($link,$SELECT);
    while($row = mysqli_fetch_assoc($result)){
        $cardList = $row;
        }
    mysqli_close($link);
    $num = substr($cardList['card_number'],-4);
    require_once('../view/buy.php');
}
elseif(isset($_POST['set']) && $_POST['set'] == 'complete'){
    $id = $_POST['id'];
    if(!isset($_POST['pay_method'])){
        $ans['pay_method'] = "選択してください";
            $link = @mysqli_connect('localhost','root','root','IH23');
            mysqli_set_charset($link,'utf8');
            $SELECT = "SELECT * FROM products WHERE id = $id;";
            $result = mysqli_query($link,$SELECT);
            while($row = mysqli_fetch_assoc($result)){
                $list = $row;
                }
            mysqli_close($link);
            $user_id = $list['user_id'];
            $link = @mysqli_connect('localhost','root','root','IH23');
            mysqli_set_charset($link,'utf8');
            $SELECT = "SELECT * FROM card_info WHERE user_id = $user_id;";
            $result = mysqli_query($link,$SELECT);
            while($row = mysqli_fetch_assoc($result)){
                $cardList = $row;
                }
            mysqli_close($link);
            $num = substr($cardList['card_number'],-4);
    }
    elseif($_POST['pay_method'] == "2"){
        if(!isset($_POST['card'])){
            $ans['card'] = "カードを選択してください";
            $link = @mysqli_connect('localhost','root','root','IH23');
            mysqli_set_charset($link,'utf8');
            $SELECT = "SELECT * FROM products WHERE id = $id;";
            $result = mysqli_query($link,$SELECT);
            while($row = mysqli_fetch_assoc($result)){
                $list = $row;
                }
            mysqli_close($link);
            $user_id = $list['user_id'];
            $link = @mysqli_connect('localhost','root','root','IH23');
            mysqli_set_charset($link,'utf8');
            $SELECT = "SELECT * FROM card_info WHERE user_id = $user_id;";
            $result = mysqli_query($link,$SELECT);
            while($row = mysqli_fetch_assoc($result)){
                $cardList = $row;
                }
            mysqli_close($link);
            $num = substr($cardList['card_number'],-4);
        }
    }
    if(!isset($ans)){
        $id = $_POST['id'];
        $link = @mysqli_connect('localhost','root','root','IH23');
        mysqli_set_charset($link,'utf8');
        $SELECT = "UPDATE products SET purchased_flag = 1 WHERE id = $id;";
        mysqli_query($link,$SELECT);
        mysqli_close($link);
        
        //パーチェスヒストリー書き込み
        //データベース接続
        $link = @mysqli_connect('localhost','root','root','IH23');
        // //文字コード設定
        mysqli_set_charset($link,'utf8');
        //sql実行
        $SQL = "INSERT INTO purchase_histories(user_id,product_id) VALUES (" . $user_id . ",".$id.");";
        // echo $SQL;
        mysqli_query($link,$SQL);
        mysqli_close($link);
        header('location: ./index.php');
        exit();
    }
    require_once('../view/buy.php');
}
else{
    header('location: ./index.php');
    exit();
}
?>