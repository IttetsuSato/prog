<?php
//2. DB接続
include("connect_db.php");

//3. データ表示SQL作成
$sql = "SELECT*FROM onder"; 
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

$view="";

if($status==false){
  $error =$stmt->errorInfo();
  exit("QueryError:".$error[2]); 
}else{
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .='<p>';
    $view .='<a href="u_view.php?id='.$result["id"].'">';
    $view .= $result["img"].' : '.$result["name"].' : '.$result["grade"].' : '.$result["college"].' : '.$result["department"].' : '.$result["hobby"].' : '.$result["hitokoto"];
    $view .= '</a>';
    $view .='　<a href="delete.php?id='.$result["id"].'">[削除]</a>';
    $view .='</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p><?=$view?></p>
</body>
</html>