<?php
function preventDirectCall()
{
    if (($_SERVER['HTTP_REFERER'] == 'https://c77f-61-19-108-218.ngrok-free.app/pcu/main/') or ($_SERVER['HTTP_REFERER'] == 'https://c77f-61-19-108-218.ngrok-free.app/pcu/main/index.php')) {
    } else {
        echo "คุณคือผู้บุกรุก";
        die();
    }
}

preventDirectCall();
