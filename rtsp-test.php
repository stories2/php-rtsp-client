<?php
    require "rtsp.php";

    $url = "rtsp://127.0.0.1/1/stream1";
    $test = new rtsp_client("127.0.0.1", 554, "admin", "admin");

    $test->connect();

    print_r($test->request("OPTIONS", $url));
    $desc = $test->request("DESCRIBE", $url);
    print_r($desc);
    $setup = $test->request("SETUP", $url, array('Transport'=>'RTP/AVP;unicast;client_port=52614-52615', 'User-Agent'=>'PHPrtsp_client/0.0.1'));
    print_r($setup);
    print_r($test->request("PLAY", $url, array('Session'=>$setup['Session'], 'User-Agent'=>'PHPrtsp_client/0.0.1', 'Range'=>'npt=0.000-')));
    print_r($test->request("GET_PARAMETER", $url, array('Session'=>$setup['Session'])));

    sleep(1);
?>
