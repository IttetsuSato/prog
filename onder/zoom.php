<?php
  function urlsafe_base64_encode($str){
    return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($str));
  }
  
  
  $zoom_url = '************';
  $zoom_api_key = "***************"; //ご自分のAPI Key
  $zoom_api_secret = "**********************:"; //ご自分のAPI Secret
  $expiration = time() + 30; //Tokenの有効期限（秒）
  
  $header = urlsafe_base64_encode('{"alg":"HS256","typ":"JWT"}');//署名アルゴリズムとトークンタイプ
  $payload = urlsafe_base64_encode('{"iss":"' . $zoom_api_key . '","exp":' . $expiration . '}');//トークン発行者（APIキー）とトークン有効期限
  $signature = urlsafe_base64_encode(hash_hmac('sha256', "$header.$payload", $zoom_api_secret , TRUE));
  $token = "$header.$payload.$signature";
  
  // 即時生成の場合
  $data_to_zoom_api = array(
    'type' => "1",
    'topic' => "会議室タイトル",
    'settings' =>array(
      'host_video'=> true,
      'participant_video'=>true,
      'join_before_host'=>true,
      'mute_upon_entry'=>false
    )
  );
  
  // //  時刻指定の場合
  // //  $data_to_zoom_api = array(
    // //    "topic" => "会議室タイトル",
    // //    "type" => "2",
    // //    "start_time" => "2020-08-17T18:30:00",
    // //    "timezone" => "Asia/Tokyo",
    // //    "settings" => array(
      // //      "use_pmi" => "false"
      // //    )
      // //  );
      
      $options = array(
        'http' => array(
          'method'=> 'POST',
          'header'=> array(
            'Content-type: application/json',
            'Authorization: Bearer ' . $token,
          ),
          'content' => json_encode($data_to_zoom_api)
          )
        );
        
        
        $context = stream_context_create($options);
        $json_result = file_get_contents($zoom_url, false, $context);
        $json_result = json_decode($json_result, true);
        // var_dump($json_result);
  $message = $json_result['start_url'];

  // //ボタンクリック(イベント）後の処理
  // if(isset($_POST['add'])){
  //   echo $message;
  // }
  ?>
  <!-- <form action="url.php" method="post">
  <button type="submit" name="add">クリックでzoom url作成</button>
  </form> -->
  <button><a class="zoom_trigger" href="<?=$message?>">start</a></button>
