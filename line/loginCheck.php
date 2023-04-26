<?php

$accToken = $_SESSION['ses_login_accToken_val'];
if($LineLogin->verifyToken($accToken)){
    $userInfo = $LineLogin->userProfile($accToken,true);
    if(isset($_SESSION['ses_login_userData_val']) && $_SESSION['ses_login_userData_val']!=""){
        // echo "<br>check local user";
        // echo "<br>projectname=".$projectName;
        // echo "<br>line_login_userData=".$_SESSION['line_login_userData_'.$projectName]['userId'];
        // print_p($_SESSION);
        
        userLog(0,$_SESSION['line_login_userData_'.$projectName]['userId'],'try login',str_replace("'"," ",$_SESSION['line_login_userData_'.$projectName]['displayName']));
        addFriend($_SESSION['line_login_userData_'.$projectName]['userId'],str_replace("'"," ",$_SESSION['line_login_userData_'.$projectName]['displayName']),$_SESSION['line_login_userData_'.$projectName]['pictureUrl']);
        $lineUserData = $_SESSION['ses_login_userData_val'];            
        $sql = "SELECT u.*,o.office_name,s.user_status_name,o.office_relation,o.office_relation_description, p.position_name,o.office_type_id,ut.homepage,ut.homepage_params FROM `user` u left join office o on u.office_id=o.office_id left join user_status s on u.user_status_id=s.user_status_id left join position p on u.position_id=p.position_id left join user_type ut on u.user_type_id=ut.user_type_id WHERE u.line_id = :line_id";
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
            $_SESSION['homepage_params']=($result[0]['user_status_id']==5)?$result[0]['homepage_params']:"";
            $_SESSION['speech2text_auto_on']=$result[0]['speech2text_auto_on'];

            $sql_update_user="update user set picture='".$_SESSION['line_login_userData_'.$projectName]['pictureUrl']."' where line_id='".$_SESSION['line_login_userData_'.$projectName]['userId']."'";
            $stmt_update_user = $conn->prepare($sql_update_user);
            $stmt_update_user->execute();

            userLog($_SESSION['user_id'],$_SESSION['line_id'],'login','Login successed.');

            // print_p($_SERVER);
            $a_request_url=explode("/",$_SERVER['REQUEST_URI']);
            // echo count($a_request_url);
            // echo "<br>REQUEST_URI=".$_SERVER['REQUEST_URI'];
            $prefix_path = str_repeat(".",(count($a_request_url)-2));
            if ($_SERVER['REQUEST_URI']=='/line/login_uselib.php'){
                ?>
                <script>
                    window.location.replace("../");
                    // redirectHome(<?php echo $result[0]['user_status_id']; ?>,<?php echo $result[0]['user_type_id']; ?>,<?php echo $result[0]['homepage']; ?>);
                </script>
                <?php
            }else{
                if (!isset($_POST['page'])){
                ?>
                <script>
                    window.location.replace("./");
                    // loadHome(<?php echo $result[0]['user_status_id']; ?>,<?php echo $result[0]['user_type_id']; ?>,'<?php echo $prefix_path; ?>');
                </script>
                <?php
                }
            }
        }
        else{
            userLog(0,$_SESSION['line_login_userData_'.$projectName]['userId'],'login','Login failed.');
            ?>
            <script>
                // loadPage("./register.php");
                redirect("../", data = {page: 'register'});

            </script>
            <?php
        }    
    }else{
        userLog(0,$accToken,'get line user data','get line user data empty.');
        ?>
        <script>
            // window.localStorage.clear();
            logout();
        </script>
        <?php
    }
}else{
    
    userLog(0,$accToken,'verify token','Verify token failed.');
    ?>
    <script>
        // window.localStorage.clear();
        <?php
        if (isset($_POST['page'])){
            ?>
            logout('<?php echo $_POST["page"]; ?>');
            <?php
        }else{
            ?>
            logout();
            <?php
        }?>
    </script>
    <?php
}
?>