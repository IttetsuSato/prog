<?php
//1.POSTデータ取得
$id       = $_POST["id"];
$name       = $_POST["name"];
$mail       = $_POST["mail"];
$college    = $_POST["college"];
$grade      = $_POST["grade"];
$department = $_POST["department"];
$hobby      = $_POST["hobby"];
$img        = $_POST["img"];
$hitokoto   = $_POST["hitokoto"];

//2. DB接続
include("connect_db.php");

//3. UPDATE
$sql = 'UPDATE onder SET name=:name,mail=:mail,college=:college,grade=:grade,department=:department,hobby=:hobby,img=:img,hitokoto=:hitokoto WHERE id=:id';//変数をそのまま入れると危険なので入れ替える

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',      $name,       PDO::PARAM_STR); 
$stmt->bindValue(':mail',      $mail,       PDO::PARAM_STR); 
$stmt->bindValue(':college',   $college,    PDO::PARAM_STR); 
$stmt->bindValue(':grade',     $grade,      PDO::PARAM_STR); 
$stmt->bindValue(':department',$department, PDO::PARAM_STR); 
$stmt->bindValue(':hobby',     $hobby,      PDO::PARAM_STR); 
$stmt->bindValue(':img',       $img,        PDO::PARAM_STR); 
$stmt->bindValue(':hitokoto',  $hitokoto,   PDO::PARAM_STR);
$stmt->bindValue(':id',        $id,         PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  $error =$stmt->errorInfo();
  exit("QueryError:".$error[2]); //エラー文
}else{
  // //5. select.phpへリダイレクト
  header("Location: select.php"); 
  exit;
}
?>