<?php
/*
 * 扫码授权模式
 */
$app_id = "ks669628970404537790";
$secret = "0VVZEf_ahB1LHt1Ka1teNw";
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
$locurl = "https://open.kuaishou.com/oauth2/qr_code?app_id=" .
    $app_id . '&scope=user_video_publish&response_type=code&redirect_uri=' . $url . '&state=state';
$access_token = '';
$upload_token = '';
if (empty($_GET['code'])) {
    header("location:$locurl");
} else {
    include_once "ks.php";
    $ks = new ks($app_id, $secret);
    $url = "https://open.kuaishou.com/oauth2/access_token?app_id=" . $app_id . "&app_secret=" . $secret . "&code=" . $_GET['code'] . "&grant_type=authorization_code";
    $res = $ks->httpRequest($url, 'get', array(), array());
    $json = json_decode($res, true);
    if ($json['result'] == 1) {
        $access_token = $json['access_token'];
        $url = "https://open.kuaishou.com/openapi/photo/start_upload?access_token=" . $access_token . '&app_id=' . $app_id;
        $res = $ks->httpRequest($url, 'post', array(), array());
        $json = json_decode($res, true);
        if ($json['result'] == 1) {
            $upload_token = $json['upload_token'];
            $url = "http://" . $json['endpoint'] . "/api/upload/multipart?upload_token=" . $upload_token;
            $file = array("file" => new CURLFile("test.mp4"));
            $res = $ks->postFile($url, $file);
            $json = json_decode($res, true);
            if ($json['result'] == 1) {
                $url = "https://open.kuaishou.com/openapi/photo/publish?access_token=" . $access_token . "&app_id=" . $app_id . "&upload_token=" . $upload_token;
                $file = array("cover" => "test.jpg", "caption" => "春已至，花已开，愿山河无恙！", "stereo_type" => "NOT_SPHERICAL_VIDEO");
                $res = $ks->postFile($url, $file);
                $json = json_decode($res, true);
                echo $res;
                if ($json['result'] == 1) {
                    echo 'ok';
                } else {
                    echo '出错了4';
                }
            } else {
                echo '出错了3';
            }
        } else {
            echo '出错了2';
        }
    } else {
        echo '出错了1';
    }
}
