<?php
ignore_user_abort(true);
set_time_limit(0);
date_default_timezone_set('PRC');
sleep(60);
$data = date("Y-m-d H:i:s");
$fp = fopen('demo2.txt', 'w');
fwrite($fp, $data);
fclose($fp);
