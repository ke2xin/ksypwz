<?php
$data = "".date("Y-m-d H:i:s");
$fp = fopen('demo.txt', 'a');
fwrite($fp, $data);
fclose($fp);
