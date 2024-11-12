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
if(isset($_POST['set']) && $_POST['set'] == 'complete'){
    //出品者ひとまず固定
    // $user_id = $_SESSION['user_id'];
        // var_dump($_POST);
        if($_FILES['imageData']['size'] === 0){
            $ans['img'] = "画像が送信されていません";
            // echo $ans['img'];
        }
        if(!isset($_POST['categories'])){
            $ans['categories'] = "カテゴリーを選択してください";
            // echo $ans['img'];
        }
        if(!isset($_POST['states'])){
            $ans['states'] = "商品の状態を選択してください";
            // echo $ans['img'];
        }
        if(empty($_POST['productName'])){
            $ans['productName'] = "商品名を入力ください";
            // echo $ans['img'];
        }
        if(empty($_POST['productDescription'])){
            $ans['productDescription'] = "商品説明文を入力してください";
            // echo $ans['img'];
        }
        if(!isset($_POST['delivery_time'])){
            $ans['delivery_time'] = "発送日時を選択してください";
            // echo $ans['img'];
        }
        if(empty($_POST['price'])){
            $ans['price'] = "金額を入力ください";
            // echo $ans['img'];
        }
        elseif(!is_numeric($_POST['price'])){
            $ans['price'] = "金額は数字でご入力ください";
            // echo $ans['img'];
        }
        //エラーがなかった時の処理
        if(!isset($ans)){
            //変数に格納
            $category = $_POST['categories'];
            $status = $_POST['states'];
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $price = $_POST['price'];
            $delivery_time = $_POST['delivery_time'];
            // var_dump($_POST);
            //ブランドを入力されている
            if(!empty($_POST['brand'])){
                $brand = $_POST['brand'];
                //画像の型調べる
                $imgType = getimagesize($_FILES['imageData']['tmp_name']);
                //ext格納
                // var_dump($imgType);
                if($imgType['mime'] == "image/png"){
                    $ext = "png";
                }
                elseif($imgType['mime'] == "image/jpeg"){
                    $ext = "jpg";
                }
                elseif($imgType['mime'] == "image/gif"){
                    $ext = "gif";
                }
                //データベース接続
                $link = @mysqli_connect('localhost','root','root','IH23');
                // //文字コード設定
                mysqli_set_charset($link,'utf8');
                //sql実行
                $SQL = "INSERT INTO products(user_id,ext,category,brand,status,product_name,product_description,price,delivery_type,delivery_time,review,comments,likes,purchased_flag) VALUES (" . $user_id . ",'" . $ext ."'," . $category .",'". $brand ."',". $status .",'" . $productName ."','" . $productDescription . "'," . $price . "," . 0 . ",".$delivery_time.",". 0 .",". 0 .",". 0 .",". 0 .");";
                // echo $SQL;
                mysqli_query($link,$SQL);
                $id = mysqli_insert_id($link);
                mysqli_close($link);
                move_uploaded_file($_FILES['imageData']["tmp_name"],"../img/".$id.'.'.$ext);

                header('location: ./product.php?id='.$id);
                exit();
            }
            //ブランド入力されていない場合
            else{
                //画像の型調べる
                $imgType = getimagesize($_FILES['imageData']['tmp_name']);
                //ext格納
                // var_dump($imgType);
                if($imgType['mime'] == "image/png"){
                    $ext = "png";
                }
                elseif($imgType['mime'] == "image/jpeg"){
                    $ext = "jpg";
                }
                elseif($imgType['mime'] == "image/gif"){
                    $ext = "gif";
                }
                //データベース接続
                $link = @mysqli_connect('localhost','root','root','IH23');
                // //文字コード設定
                mysqli_set_charset($link,'utf8');
                //sql実行
                $SQL = "INSERT INTO products(user_id,ext,category,status,product_name,product_description,price,delivery_type,delivery_time,review,comments,likes,purchased_flag) VALUES (" . $user_id . ",'" . $ext ."'," . $category .",". $status .",'" . $productName ."','" . $productDescription . "'," . $price . "," . 0 . ",".$delivery_time.",". 0 .",". 0 .",". 0 .",". 0 .");";
                // echo $SQL;
                mysqli_query($link,$SQL);
                $id = mysqli_insert_id($link);
                mysqli_close($link);
                move_uploaded_file($_FILES['imageData']["tmp_name"],"../img/".$id.'.'.$ext);

                header('location: ./product.php?id='.$id);
                exit();
            }
        }
}

require_once('../view/upload.php');
?>