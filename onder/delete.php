<?php
//1.GETでid取得
$id=$_GET["id"];

//2. DB接続します（エラー処理追加）
include("connect_db.php");

//3. DDELETE
$sql = "DELETE FROM onder WHERE id=:id"; 

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',    $id,     PDO::PARAM_INT);
$status = $stmt->execute();

$view="";

if($status==false){
  $error =$stmt->errorInfo();
  exit("QueryError:".$error[2]); 
}else{
  header("Location: select.php");
}
?>