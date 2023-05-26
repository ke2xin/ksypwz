<?php
$data = file_get_contents("php://input");
$fp = fopen('123.txt', 'w');
fwrite($fp, $data);
fclose($fp);
$a = json_decode($data, true);
$result['result'] = 1;
$result['message_id'] = $a['message_id'];
echo json_encode($result);
