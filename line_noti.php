#Line Notify .php
define('LINE_API',"https://notify-api.line.me/api/notify");
$token = ""; //ใส่ Token ที่ได้จาก Line

$str = "Roikoh Test"; //ข้อความที่ต้องการส่ง
$resp = notify_message($str,$token);

function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $resp = json_decode($result);
 return $resp;
}