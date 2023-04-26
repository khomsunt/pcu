<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SERVER['HTTP_REFERER'])){
        if (!isset($_SESSION['line_id'])){
            header("Location: ../line/login_uselib.php?page=".$page);
        }
    }
    // print_p($_SERVER);
    if (!isset($history)){
        $history = new stdClass();
    }
    $history->PHP_SELF = $_SERVER['PHP_SELF'];
    $history->POST=$_POST;
    if (!isset($_SESSION['history'])){
        $_SESSION['history']=array();
    }
    // print_p($_SESSION);
    $_SESSION['history']=upsertJson($_SESSION['history'],"PHP_SELF",$history->PHP_SELF,json_encode($history));
    $historyBack=searchJson($_SESSION['history'],"PHP_SELF",$backToUrl);
    // echo "<br>historyBack=".$historyBack;
    $thisHistoryBack=json_decode($_SESSION['history'][$historyBack]);
    // print_p($thisHistoryBack);
    // print_p($thisHistoryBack->POST);
    // echo "<br>thisHistoryBack=".$thisHistoryBack;
    // print_p($_SESSION);
?>