<?php

define('LINE_LOGIN_CHANNEL_ID', '1660984707');
define('LINE_LOGIN_CHANNEL_SECRET', '65a4cd446970583aec3339936846a296');
define('LINE_LOGIN_CALLBACK_URL', 'https://c77f-61-19-108-218.ngrok-free.app/pcu/line/login_uselib_callback.php?projectName=pcu');

$LineLogin = new LineLoginLib(
    LINE_LOGIN_CHANNEL_ID, LINE_LOGIN_CHANNEL_SECRET, LINE_LOGIN_CALLBACK_URL);
