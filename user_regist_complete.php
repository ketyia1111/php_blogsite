<?php

#基本設定
declare(strict_types=1);
require_once("filename.php");
require_once("db.php");

#セッション
session_start();

#ファイル取得
$file = new Filename();

$html = $file::HTML_REGIST_COMP;
$html = file_get_contents($html);

#前画面
$before = $file::PHP_REGIST_INP;

#変数を定数化
$name = (string)($_POST["name"] ?? "");
$mail = (string)($_POST["mail"] ?? "");
$password = (string)($_POST["password"] ?? "");

#値の確認
if($name === "" || $mail === "" || $password === ""){
    #セッション
    $_SESSION["error"] = "値に不備があります";
    $_SESSION["name"] = $name;
    $_SESSION["mail"] = $mail;

    header("Location: {$before}");

}

$password = password_hash($password,PASSWORD_DEFAULT);

#データベース処理
try{
    $dbh = db::connect();

    $sql = 'insert users(name,mailadd,password) values(:name,:mail,:password)';

    $pre = $dbh->prepare($sql);
    
    $pre->bindValue(":name",$name,pdo::PARAM_STR);
    $pre->bindValue(":mail",$mail,pdo::PARAM_STR);
    $pre->bindValue(":password",$password,pdo::PARAM_STR);

    $result = $pre->execute();
}catch(PDOException $e){
    echo $e->getMessage();
}

#htmlの取得
print($html);
