<?php
ignore_user_abort(true);
set_time_limit(0);
date_default_timezone_set('PRC');
set_time_limit(0);
ob_end_clean();
header("Connection:close");
header("HTTP/1.1 200 OK");
$data='demo1';
$fp = fopen('demo1.txt', 'w');
fwrite($fp, $data);
fclose($fp);
$a=file_get_contents("http://yp.kosm.com.cn/wlw/wlw_jk/kk_jk.php?cmd=rs,0,0&jqm=1010021966&lb=2&ddh=1111www8882");
ob_start();
$arr=['文件生成中'];
echo json_encode($arr);
$size=ob_get_length();
header("Content-Length: ".$size);
ob_end_flush();
flush();
#pclose(popen('php demo2.php &', 'r'));
sleep(20);
ignore_user_abort(true);
set_time_limit(0);
$data = date("Y-m-d H:i:s");
$fp = fopen('demo2.txt', 'w');
fwrite($fp, $data);
fclose($fp);
$a=file_get_contents("http://yp.kosm.com.cn/wlw/wlw_jk/kk_jk.php?cmd=rs,0,-1&jqm=1010021966&lb=2&ddh=1111www8881");
function https_post($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
