<?php
  $client_id  = "IWaE_iQfcPjVQ0KH3K7m";
	$client_secret = "P7wtd3u6sA";
$callback = $_GET['callback'];
  // $s="asas";
  $s= $_GET['abc'];

      $encText = urlencode($s);
      $postvars = "speaker=yuri&speed=0&text=".$encText;//yuri = 일본인 mijin = 한국
      $url = "https://openapi.naver.com/v1/voice/tts.bin";
      $is_post = true;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, $is_post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
      $headers = array();
      $headers[] = "X-Naver-Client-Id: ".$client_id;
      $headers[] = "X-Naver-Client-Secret: ".$client_secret;
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      $response = curl_exec ($ch);
      $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      // echo "status_code:".$status_code;
      curl_close ($ch);
      if($status_code == 200) {
        //echo $response;
        $fp = fopen("{$s}.mp3", "w+");
        fwrite($fp, $response);
        fclose($fp);
        // $result = "<iframe width='560' height='315' src='$s.mp3' ></iframe>";
        // $result =  "<audio width='560' height='315' src='http://172.19.1.55/project/$encText.mp3' >ddd</audio>";
      $result =  "
      <audio controls='controls' autoplay='autoplay' style='margin:50px auto;'>
        <source src='http://urias-heoyongjun.c9users.io/blindcare/sound/$encText.mp3' type='audio/mp3'/>
      </audio>";
      } else {
        $result =  "Error 내용:".$response;
      }
      // $result= $s ;
      echo $callback."(".json_encode($result).")";




 ?>
