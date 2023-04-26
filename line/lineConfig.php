<?php

define('LINE_LOGIN_CHANNEL_ID','1657696513');
define('LINE_LOGIN_CHANNEL_SECRET','f10e87365a2e04e1f473d54704d27a65');
define('LINE_LOGIN_CALLBACK_URL','https://1669-snk.moph.go.th/commander/line/login_uselib_callback.php?projectName=1669');
 
$LineLogin = new LineLoginLib(
    LINE_LOGIN_CHANNEL_ID, LINE_LOGIN_CHANNEL_SECRET, LINE_LOGIN_CALLBACK_URL);
?>