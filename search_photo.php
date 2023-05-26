<?php
$app_id = "ks669628970404537790";
$secret = "0VVZEf_ahB1LHt1Ka1teNw";
$redirect_uri = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
$url = "https://open.kuaishou.com/oauth2/authorize?app_id=" . $app_id .
    "&scope=user_video_info,user_video_mp_plc&response_type=code&redirect_uri=" . $redirect_uri . "&state=state";
$access_token = "";

if (empty($_GET['code'])) {
    header("location:$url");
} else {
    include_once "ks.php";
    $ks = new ks($app_id, $secret);
    $url = "https://open.kuaishou.com/oauth2/access_token?app_id=" . $app_id . "&app_secret=" . $secret . "&code=" . $_GET['code'] . "&grant_type=authorization_code";
    $res = $ks->httpRequest($url, 'get', array(), array());
    $json = json_decode($res, true);
    if ($json['result'] == 1) {
        $access_token = $json['access_token'];
        $url = "https://open.kuaishou.com/openapi/photo/list?access_token=" . $access_token . "&app_id=" . $app_id;
        $res = $ks->httpRequest($url, 'get', array(), array());
        //echo $res;
        $json = json_decode($res, true);
        if ($json['result'] == 1) {
            $arr = $json['video_list'];
            if (!empty($arr)) {
                //print_r($arr[0]);
                $item = $arr[0];
                $photo_id = $item['photo_id'];
                echo $photo_id;
                $url = "https://open.kuaishou.com/openapi/photo/mp_plc/bind";
                $data['access_token'] = $access_token;
                $data['app_id'] = $app_id;
                $data['photo_id'] = $photo_id;
                $data['plc_mp_app_id'] = 'ks684265671986219150';
                $data['plc_title'] = '用朋免费入驻，立即入驻';
                $data['plc_mp_path'] = 'pages/index/index';
                $res = $ks->httpRequest($url, 'post', $data, array());
                echo $res;
            }
        } else {
            echo '出错2';
        }
    } else {
        echo '出错了1';
    }
}
