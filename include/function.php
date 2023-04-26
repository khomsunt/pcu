<?php
function preventDirectCall()
{
    if (($_SERVER['HTTP_REFERER'] == $_SERVER['HTTP_ORIGIN'] . '/pcu/main/') or ($_SERVER['HTTP_REFERER'] == $_SERVER['HTTP_ORIGIN'] . '/pcu/main/index.php')) {
    } else {
        echo "คุณคือผู้บุกรุก";
        die();
    }
}

preventDirectCall();
