<?php
// error_reporting(E_ALL);
// ini_set('display_errors','On');

if (!isset($_SESSION)){
    session_start();
}
// error_log("register",0);
include("../db/connection.php");
include("../include/function.php");
include("../include/protectDir.php");
require_once("../line/function.php");
require_once("../line/lineLoginLib.php");
require_once("../line/lineConfig.php");

if(!isset($_SESSION['ses_login_accToken_val'])){   
    $_POST['page']="register";
    include_once("../line/loginCheck.php");
}else{
    ?>
    <form action="" id="registerInsert" style="padding-bottom: 200px;">
        <?php 
        if (isset($_POST['user_id'])){
            ?>
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_POST['user_id']; ?>">
            <?php
            $sql="select * from user where user_id=".$_POST['user_id'];
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($user);
        } ?>
        <div class="mb-1">
            <label for="callsign" class="form-label" speech="นามเรียกขาน">นามเรียกขาน</label>
            <input type="text" class="form-control" id="callsign" name="callsign" placeholder="" value="<?php echo (isset($user))?$user['callsign']:""; ?>">
        </div>
        <div class="mb-1">
            <label for="prename" class="form-label required" speech="คำนำหน้าชื่อ">คำนำหน้าชื่อ</label>
            <input type="text" class="form-control" id="prename" name="prename" placeholder="" value="<?php echo (isset($user))?$user['prename']:""; ?>" required>
        </div>
        <div class="mb-1">
            <label for="user_first_name" class="form-label required" speech="ชื่อ">ชื่อ</label>
            <input type="text" class="form-control" id="user_first_name" name="user_first_name" placeholder="" value="<?php echo (isset($user))?$user['user_first_name']:""; ?>" required>
        </div>
        <div class="mb-1">
            <label for="user_last_name" class="form-label required" speech="นามสกุล">นามสกุล</label>
            <input type="text" class="form-control" id="user_last_name" name="user_last_name" placeholder="" value="<?php echo (isset($user))?$user['user_last_name']:""; ?>" required>
        </div>
        <div class="mb-1">
            <label for="cid" class="form-label required" speech="เลขบัตรประชาชน">เลขบัตรประชาชน</label>
            <input type="text" class="form-control" id="cid" name="cid" placeholder="" value="<?php echo (isset($user))?$user['cid']:""; ?>" required>
        </div>
        <?php
        if (!(isset($_POST['user_id']))){
            ?>
            <div class="mb-1">
                <label for="password" class="form-label required" speech="รหัสผ่าน">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="" value="<?php echo (isset($user))?$user['password']:""; ?>" required>
            </div>
            <?php
        } ?>
        <div class="mb-1">
            <label for="office_id" class="form-label required" speech="เลือกหน่วยงาน">หน่วยงาน</label>
            <select id="office_id" name="office_id" class="form-select select2" aria-label="Default select example" required>
                <option <?php echo ($user['office_id']=="0" or $user['office_id']=="")?"selected":""; ?> value="0">เลือกหน่วยงาน</option>
                <?php 
                if ($_POST['user_id']>0 and $_SESSION['user_type_id']>1){
                    $sql="select * from office p where p.office_relation like '".$_SESSION['office_relation']."%' order by p.office_relation";
                }else{
                    $sql="select * from office p order by p.office_relation";
                }
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while ($office = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $office['office_id']; ?>" <?php echo ($office['office_id']==$user['office_id'])?"selected":""; ?>><?php echo str_repeat("&nbsp;",strlen($office['office_relation'])-6).(($office['office_type_id']==1)?"+ ":"- ").$office['office_name']; ?></option>
                    <?php
                } ?>
            </select>
        </div>


        <div class="mb-1">
            <label for="position_id" class="form-label required" speech="ตำแหน่ง">ตำแหน่ง</label>
            <select id="position_id" name="position_id" class="form-select select2" aria-label="Default select example" required>
                <option <?php echo ($user['position_id']=="0" or $user['position_id']=="")?"selected":""; ?> value="0">เลือกตำแหน่ง</option>
                <?php 
                $sql="select * from position p order by p.position_name";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while ($position = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $position['position_id']; ?>" <?php echo ($position['position_id']==$user['position_id'])?"selected":""; ?>><?php echo $position['position_name']; ?></option>
                    <?php
                } ?>
            </select>
        </div>
        <div class="mb-1">
            <label for="position_level_id" class="form-label" speech="ระดับ">ระดับ</label>
            <select id="position_level_id" name="position_level_id" class="form-select select2" aria-label="Default select example" required>
                <option <?php echo ($user['position_level_id']=="0" or $user['position_level_id']=="")?"selected":""; ?> value="0">เลือกระดับ</option>
                <?php 
                $sql="select * from position_level p order by p.position_level_name";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while ($position_level = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $position_level['position_level_id']; ?>" <?php echo ($position_level['position_level_id']==$user['position_level_id'])?"selected":""; ?>><?php echo $position_level['position_level_name']; ?></option>
                    <?php
                } ?>
            </select>
        </div>
        <div class="mb-1">
            <label for="address" class="form-label required" speech="ที่อยู่">ที่อยู่</label>
            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo (isset($user))?$user['address']:""; ?></textarea>
        </div>
        <div class="mb-1">
            <label for="tel" class="form-label required" speech="เบอร์โทรศัพท์">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" id="tel" name="tel" placeholder="" value="<?php echo (isset($user))?$user['tel']:""; ?>" required>
        </div>

        <?php
        if (isset($_POST['user_id']) and (in_array($_SESSION['user_type_id'],[1,2]) and $_SESSION['user_status_id']==5)){
            ?>
            <div class="mb-1">
                <label for="user_type_id" class="form-label required" speech="เลือกสิทธิ์การใช้งาน">สิทธิ์การใช้งาน</label>
                <select id="user_type_id" name="user_type_id" class="form-select select2" aria-label="Default select example" required>
                    <option <?php echo ($user['user_type_id']=="0" or $user['user_type_id']=="")?"selected":""; ?> value="0">เลือกสิทธิ์การใช้งาน</option>
                    <?php 
                    $sql="select * from user_type p where user_type_id>=".$_SESSION['user_type_id']." order by p.user_type_name";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($user_type = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $user_type['user_type_id']; ?>" <?php echo ($user_type['user_type_id']==$user['user_type_id'])?"selected":""; ?>><?php echo $user_type['user_type_name']; ?></option>
                        <?php
                    } ?>
                </select>
            </div>
            <div class="mb-1">
                <label for="user_status_id" class="form-label required" speech="เลือกสถานะการใช้งาน">สถานะการใช้งาน</label>
                <select id="user_status_id" name="user_status_id" class="form-select select2" aria-label="Default select example" required>
                    <option <?php echo ($user['user_status_id']=="0" or $user['user_status_id']=="")?"selected":""; ?> value="0">เลือกสถานะการใช้งาน</option>
                    <?php 
                    $sql="select * from user_status p order by p.user_status_name";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($user_status = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $user_status['user_status_id']; ?>" <?php echo ($user_status['user_status_id']==$user['user_status_id'])?"selected":""; ?>><?php echo $user_status['user_status_name']; ?></option>
                        <?php
                    } ?>
                </select>
            </div>
            <div class="mb-1">
                <label for="ambulance_id" class="form-label" speech="ประจำรถฉุกเฉิน">ประจำรถฉุกเฉิน</label>
                <select id="ambulance_id" name="ambulance_id" class="form-select select2" aria-label="Default select example">
                    <option <?php echo ($user['ambulance_id']=="0" or $user['ambulance_id']=="")?"selected":""; ?> value="0">เลือกรถฉุกเฉิน</option>
                    <?php 
                    $sql="select a.ambulance_id,concat(a.callsign,' #',a.register_no) as ambulance_name from ambulance a left join office o on a.office_id=o.office_id where o.office_relation like '".$_SESSION['office_relation']."%'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while ($row_ambulance = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $row_ambulance['ambulance_id']; ?>" <?php echo ($row_ambulance['ambulance_id']==$user['ambulance_id'])?"selected":""; ?>><?php echo $row_ambulance['ambulance_name']; ?></option>
                        <?php
                    } ?>
                </select>
            </div>

            <?php
        } ?>

        <div class="mb-1 text-end p-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" speech="ยกเลิก">ยกเลิก</button>
            <button form_name="registerInsert" path="./line/" ok="<?php echo ($_POST['user_id'] and (in_array($_SESSION['user_type_id'],[1,2]) and $_SESSION['user_status_id']==5))?"./user/index.php":"./user/userInfo.php"; ?>" type="submit" class="form-save-btn-register btn btn-primary" speech="บันทึก">บันทึก</button>
        </div>
        <input type="hidden" name="line_id" id="line_id" value="<?php echo $_SESSION['line_login_userData_'.$projectName]['userId']; ?>">
        <input type="hidden" name="picture" id="picture" value="<?php echo $_SESSION['line_login_userData_'.$projectName]['pictureUrl']; ?>">
    </form>

    <script>

        $(function(){

            $('.select2').select2({
                dropdownParent: $("#index-modal")
            });


            $(document).off("click", ".form-save-btn-register").on("click", ".form-save-btn-register", function (e) {
                let this_btn=$(this);
                let this_user_id = $("#registerInsert").find("#user_id").val();
                if ($('#registerInsert')[0].checkValidity()) {
                    $(this_btn).prop("disabled", true);
                    // e.preventDefault();
                    loadingShow();
                    $.ajax({
                        method: "POST",
                        url: "./line/user_cid_check.php",
                        data: { cid: $("#cid").val() }
                    })
                    .done(function( msg ) {
                        let a_user = JSON.parse(msg);
                        let cid_dup = false;
                        if (this_user_id>0){
                            if (a_user.recordsTotal>1){
                                cid_dup=true;
                            }else{
                                if (a_user.recordsTotal===1){
                                    if (a_user.data[0].user_id==this_user_id){
                                    }else{
                                        cid_dup=true;
                                    }                                    
                                }
                            }
                        }else{
                            if (a_user.recordsTotal>0){
                                cid_dup=true;
                            }
                        }
                        if (cid_dup===false){
                            // if (!$(this).checkValidity()) {
                            //   alert("กรอกข้อมูลยังไม่ครบ");
                            // } else {
                            let form_name = $(this_btn).attr("form_name");
                            let path = $(this_btn).attr("path");
                            let action = path + form_name + ".php";
                            let redirect_ok = $(this_btn).attr("ok");
                            let data = $("#" + form_name).serialize();
                            //console.log("action=",action);
                            callAjax(action, data, redirect_ok);
                            // }
                        }else{
                            myAlert("เลขบัตรประชาชนซ้ำ โปรดตรวจสอบอีกครั้ง");
                            $(this_btn).prop("disabled", false);
                            $("#cid").focus();
                        }

                    }); 



                  // Form is valid;
                } else {
                    console.log("form is invalid");
                  // Form is invalid;
                }                
            });


            $("#changwat_code").off("change").on("change",function(){
                setOption(
                    "./util/getCode.php",
                    {
                        "table":"ampur",
                        "filter_name":"changwat_code",
                        "filter_operation":"=",
                        "filter_value":$(this).val(),
                        "order_by":"ampur_name"
                    },
                    {
                        "target":"ampur_code",
                        "value":"ampur_code",
                        "text":"ampur_name"
                    }
                );
                clearOption({"target":"tambon_code"});
                clearOption({"target":"village_code"});
            });

            $("#ampur_code").off("change").on("change",function(){
                setOption(
                    "./util/getCode.php",
                    {
                        "table":"tambon",
                        "filter_name":"ampur_code",
                        "filter_operation":"=",
                        "filter_value":$(this).val(),
                        "order_by":"tambon_name"
                    },
                    {
                        "target":"tambon_code",
                        "value":"tambon_code",
                        "text":"tambon_name"
                    }
                );
                clearOption({"target":"village_code"});
            });

            $("#tambon_code").off("change").on("change",function(){
                setOption(
                    "./util/getCode.php",
                    {
                        "table":"village",
                        "filter_name":"tambon_code",
                        "filter_operation":"=",
                        "filter_value":$(this).val(),
                        "order_by":"village_name"
                    },
                    {
                        "target":"village_code",
                        "value":"village_code",
                        "text":"village_name"
                    }
                );
            });

        })
    </script>
    <?php
} ?>