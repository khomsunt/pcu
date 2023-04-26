<?php
function userLog($user_id,$line_id,$action,$result){
    global $conn;
    $http_user_agent=$_SERVER['HTTP_USER_AGENT'];
    $remote_addr=$_SERVER['REMOTE_ADDR'];
    $sql = "INSERT into user_log (user_id,line_id,action,result,remote_addr,http_user_agent) VALUE (".(($user_id)?$user_id:0).",'".(($line_id)?$line_id:"")."','".(($action)?$action:"")."','".(($result)?$result:"")."','".(($remote_addr)?$remote_addr:"")."','".(($http_user_agent)?$http_user_agent:"")."')";
    $result_conn = $conn->prepare($sql);
    $result_conn->execute();
}

function addFriend($line_id,$display_name,$picture_url){
    global $conn;
    $sql="select * from line_friend where line_id='".$line_id."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows=$stmt->rowCount();
    if ($rows>0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $sql="update line_friend set display_name='".str_replace("'"," ",$display_name)."', picture_url='".$picture_url."', visits=".($row['visits']+1)." where line_id='".$line_id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }else{
        $sql="insert into line_friend (line_id,display_name,picture_url,visits) value ('".$line_id."','".str_replace("'"," ",$display_name)."','".$picture_url."',1)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}

function loginCheck(){
    global $LineLogin, $conn, $projectName;
    $_return=false;
    $accToken = $_SESSION['ses_login_accToken_val'];
    if($LineLogin->verifyToken($accToken)){
        // echo "<br>accToken=".$accToken;
        $userInfo = $LineLogin->userProfile($accToken,true);
        if(isset($_SESSION['ses_login_userData_val']) && $_SESSION['ses_login_userData_val']!=""){
            // echo "<br>check local user";
            // echo "<br>projectname=".$projectName;
            // echo "<br>line_login_userData=".$_SESSION['line_login_userData_'.$projectName]['userId'];
            // print_p($_SESSION);
            
            userLog(0,$_SESSION['line_login_userData_'.$projectName]['userId'],'try login',str_replace("'"," ",$_SESSION['line_login_userData_'.$projectName]['displayName']));
            addFriend($_SESSION['line_login_userData_'.$projectName]['userId'],str_replace("'"," ",$_SESSION['line_login_userData_'.$projectName]['displayName']),$_SESSION['line_login_userData_'.$projectName]['pictureUrl']);
            $lineUserData = $_SESSION['ses_login_userData_val'];            
            $sql = "SELECT u.*,o.office_name,s.user_status_name,o.office_relation,o.office_relation_description, p.position_name,o.office_type_id,ut.homepage FROM `user` u left join office o on u.office_id=o.office_id left join user_status s on u.user_status_id=s.user_status_id left join position p on u.position_id=p.position_id left join user_type ut on u.user_type_id=ut.user_type_id WHERE u.line_id = :line_id";
            // echo "<br>sql=".$sql;
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':line_id'=> $_SESSION['line_login_userData_'.$projectName]['userId']));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo "<br>lineUserData['userId']=".$_SESSION['line_login_userData_'.$projectName]['userId'];
            // print_r($result);
            if (count($result)>0) {
                $_SESSION['user_id']=$result[0]['user_id'];
                $_SESSION['user_first_name']=$result[0]['user_first_name'];
                $_SESSION['user_last_name']=$result[0]['user_last_name'];
                $_SESSION['position_name']=$result[0]['position_name'];
                $_SESSION['line_id']=$result[0]['line_id'];
                $_SESSION['user_picture']=$result[0]['picture'];
                $_SESSION['main_office_id']=getMainOfficeId($result[0]['office_relation']);
                $_SESSION['office_id']=$result[0]['office_id'];
                $_SESSION['office_type_id']=$result[0]['office_type_id'];
                $_SESSION['office_relation']=$result[0]['office_relation'];
                $_SESSION['office_relation_description']=$result[0]['office_relation_description'];
                $_SESSION['office_name']=$result[0]['office_name'];
                $_SESSION['user_status_id']=$result[0]['user_status_id'];
                $_SESSION['user_type_id']=($result[0]['user_status_id']==5)?$result[0]['user_type_id']:0;
                $_SESSION['homepage']=($result[0]['user_status_id']==5)?$result[0]['homepage']:"";
                $_SESSION['speech2text_auto_on']=$result[0]['speech2text_auto_on'];
                $sql_update_user="update user set picture='".$_SESSION['line_login_userData_'.$projectName]['pictureUrl']."' where line_id='".$_SESSION['line_login_userData_'.$projectName]['userId']."'";
                $stmt_update_user = $conn->prepare($sql_update_user);
                $stmt_update_user->execute();

                userLog($_SESSION['user_id'],$_SESSION['line_id'],'login','Login successed.');
                $_return=true;
            }else{
                unset(
                    $_SESSION['user_id'],
                    $_SESSION['user_first_name'],
                    $_SESSION['user_last_name'],
                    $_SESSION['position_name'],
                    $_SESSION['user_picture'],
                    $_SESSION['main_office_id'],
                    $_SESSION['office_id'],
                    $_SESSION['office_type_id'],
                    $_SESSION['office_relation'],
                    $_SESSION['office_relation_description'],
                    $_SESSION['office_name'],
                    $_SESSION['user_type_id'],
                    $_SESSION['homepage'],
                    $_SESSION['speech2text_auto_on'],
                    $_SESSION['user_status_id'],
                    $_SESSION['line_id']
                );  
                userLog(0,$_SESSION['line_login_userData_'.$projectName]['userId'],'login','Login failed.');
            } 
        }
    }
    return $_return;   
}
?>