<?php

#基本設定
declare(strict_types=1);
require_once("filename.php");

#セッション
session_start();

#ファイル取得
$file = new Filename();

$html = $file::HTML_REGIST_INP;
$html = file_get_contents($html);

#次画面
$next = $file::PHP_REGIST_COMP;

#変数を変数化
$name = "";
$mail = "";
$password = "";
$error = "";

#値の保持
if(isset($_SESSION["error"])){
    $error = $_SESSION["error"];
    $name = $_SESSION["name"];
    $name = $_SESSION["mail"];

    unset($_SESSION["error"]);
    unset($_SESSION["name"]);
    unset($_SESSION["mail"]);
}

#値埋め込み
$html = str_replace("#next",htmlspecialchars($next,ENT_QUOTES,'UTF-8'),$html);
$html = str_replace(":name:",htmlspecialchars($name,ENT_QUOTES,'UTF-8'),$html);
$html = str_replace(":mail:",htmlspecialchars($mail,ENT_QUOTES,'UTF-8'),$html);
$html = str_replace(":password:",htmlspecialchars($password,ENT_QUOTES,'UTF-8'),$html);
$html = str_replace("#error",htmlspecialchars($error,ENT_QUOTES,'UTF-8'),$html);

print($html);