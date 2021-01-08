<?php
//入力チェック
if(
  !isset($_POST["name"])       || $_POST["name"]==""       ||
  !isset($_POST["mail"])       || $_POST["mail"]==""       ||
  !isset($_POST["college"])    || $_POST["college"]==""    ||
  !isset($_POST["grade"])      || $_POST["grade"]==""      ||
  !isset($_POST["department"]) || $_POST["department"]=="" ||
  !isset($_POST["hobby"])      || $_POST["hobby"]==""      ||
  !isset($_POST["img"])        || $_POST["img"]==""        ||
  !isset($_POST["hitokoto"])   || $_POST["hitokoto"]=="" 
){
  exit('ParamError');
}

//1.POSTデータ取得
$name       = $_POST["name"];
$mail       = $_POST["mail"];
$college    = $_POST["college"];
$grade      = $_POST["grade"];
$department = $_POST["department"];
$hobby      = $_POST["hobby"];
$img        = $_POST["img"];
$hitokoto   = $_POST["hitokoto"];

//2. DB接続（エラー処理追加）
include("connect_db.php");

//3. データ登録SQL作成
$sql = "INSERT INTO onder(id, name, mail, college, grade, department, hobby, img, hitokoto, indate)VALUES(NULL,:a1,:a2,:a3,:a4, :a5, :a6, :a7, :a8,
sysdate())"; 

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':a1',$name,       PDO::PARAM_STR); 
$stmt->bindValue(':a2',$mail,       PDO::PARAM_STR); 
$stmt->bindValue(':a3',$college,    PDO::PARAM_STR); 
$stmt->bindValue(':a4',$grade,      PDO::PARAM_STR); 
$stmt->bindValue(':a5',$department, PDO::PARAM_STR); 
$stmt->bindValue(':a6',$hobby,      PDO::PARAM_STR); 
$stmt->bindValue(':a7',$img,        PDO::PARAM_STR); 
$stmt->bindValue(':a8',$hitokoto,   PDO::PARAM_STR);
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  $error =$stmt->errorInfo();
  exit("QueryError:".$error[2]); //エラー文
}else{
  //5. index.phpへリダイレクト
  header("Location: index.php"); 
  exit;
}
?>