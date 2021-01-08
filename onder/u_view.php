<?php
//1.GETでidを取得
$id = $_GET["id"];

//2. DB接続
include("connect_db.php");
//3. SELECT * FROM gs_an_table WHERE id=:id
$sql = "SELECT * FROM onder WHERE id=:id"; 
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ表示
if($status==false){
  $error =$stmt->errorInfo();
  exit("QueryError:".$error[2]); //エラー文
}else{
  //データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
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
  <form action="update.php" method="post">
    <label>お名前:        <input type="text"  name="name"       value="<?=$row["name"]?>"></label><br>
    <label>メールアドレス:<input type="email" name="mail"       value="<?=$row["mail"]?>"></label><br>
    <label>大学名:        <input type="text"  name="college"    value="<?=$row["college"]?>"></label><br>
    <label>学年:          <input type="text"  name="grade"      value="<?=$row["grade"]?>"></label><br>
    <label>学部:          <input type="text"  name="department" value="<?=$row["department"]?>"></label><br>
    <label>趣味:          <input type="text"  name="hobby"      value="<?=$row["hobby"]?>"></label><br>
    <label>写真:          <input type="text"  name="img"        value="<?=$row["img"]?>"></label><br>
    <label>ひとこと:      <textarea name="hitokoto" rows="4" cols="40"><?=$row["hitokoto"]?></textarea></label><br>
    <input type="hidden" name="id" value="<?=$row["id"]?>">
      <input type="submit" value="送信">
  </form>

  
  </form>
</body>
</html>