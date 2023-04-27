<?php

define('LINE_LOGIN_CHANNEL_ID', '1660988308');
define('LINE_LOGIN_CHANNEL_SECRET', '61220de81be3f5aeadb7c0733af486f6');
define('LINE_LOGIN_CALLBACK_URL', 'https://72a7-61-19-108-218.ngrok-free.app/pcu/line/login_uselib_callback.php?projectName=pcu');

$LineLogin = new LineLoginLib(
    LINE_LOGIN_CHANNEL_ID, LINE_LOGIN_CHANNEL_SECRET, LINE_LOGIN_CALLBACK_URL);
