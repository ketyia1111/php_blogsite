<?php
declare(strict_types=1);

class db{

    public static function connect(){

        #返すDBの情報
        static $dbh = null;

        #接続の情報
        $host = "db"; //コンテナ名
        $dbname = "blogs";
        $username = "root";
        $password = "password";

        #接続処理
        try{
            $dbh = new PDO(
                "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
                $username,
                $password,
                //オプション
                [
                    #エミュレーションを無効
                    PDO::ATTR_EMULATE_PREPARES => false,
                    #複合無効
                    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                ] 
            );
        }catch(PDOException $e){
            echo $e->getMessage();
            return ;
        }
    return $dbh;
    }
}