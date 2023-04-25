<?php
function preventDirectCall()
{
    if ($_SERVER['HTTP_REFERER'] != 'http://localhost/pcu/main/') {
        echo "คุณคือผู้บุกรุก";
        die();
    }
}

preventDirectCall();
