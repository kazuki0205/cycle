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
if(isset($_POST['set']) && $_POST['set'] == 'complete'){
    if(empty($_POST['mail'])){
        $ans['mail'] = "メールを入力してください";
        // echo $ans['img'];
    }
    if(empty($_POST['pass'])){
        $ans['pass'] = "パスワードを入力してください";
        // echo $ans['img'];
    }
    if(!isset($ans)){
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $link = @mysqli_connect('localhost','root','root','IH23');
        mysqli_set_charset($link,'utf8');
        $SELECT = "SELECT * FROM users WHERE mail = '".$mail."' AND password = '".$pass."';";
        // echo $SELECT;
        $result = mysqli_query($link,$SELECT);
        // $i = 0;
        if($row = mysqli_fetch_assoc($result)){
            $_SESSION['user_id'] = $row['id'];
            header('location: ./index.php');
            exit();
        }
        else{
            $ans['error'] = "ログインできませんでした";
            require_once('../view/login.php');
        }
        mysqli_close($link);
    }
}
require_once('../view/login.php');
?>