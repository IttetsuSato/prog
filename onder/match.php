<?php
//2. DB接続
include("connect_db.php");

$sql = "SELECT COUNT(*) FROM onder"; 
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if($status==false){
  $error =$stmt->errorInfo();
  exit("QueryError:".$error[2]); 
}else{
  $row = $stmt->fetch();
  $length = $row[0];
  }
$random = rand ( 1 , $length ); 
//3. データ表示SQL作成
$sql = "SELECT*FROM onder WHERE id=:id"; 
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $random, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  $error =$stmt->errorInfo();
  exit("QueryError:".$error[2]); 
}else{
  $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <div class="timer">10</div>
  <img class="bgimg" src="images/party.jpeg" alt="">
  <div class="back"><img src="images/cardback.jpeg" alt=""></div>
  <div class="card">
    <div class="card_img"><img src="images/img-1.jpg" alt=""></div>
    <div class="card_prof">
      <div class="card_top">
        <div class="card_name"><?=$row["name"]?></div>
        <div class="card_grade"><?=$row["grade"]?></div>
      </div>
      <div class="card_middle">
        <div class="card_college"><?=$row["college"]?></div>
        <div class="card_department"><?=$row["department"]?></div>
      </div>
      <div class="card_bottom">
        <div class="card_hobby"><?=$row["hobby"]?></div>
      </div>
      <div class="card_hitokoto"><?=$row["hitokoto"]?></div>
    </div>
  </div>
  <?=include('zoom.php')?>
  <script src="js/f.js"></script>
</body>
</html>