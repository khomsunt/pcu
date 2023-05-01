<br><br>
<b>ทะเบียน</b>
<div class="list-group pt-3 p-1 list-group-flush" style="width:240px;">
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../office/office.php" target_div="display">
        ทะเบียนหน่วยงาน
        <span class="badge bg-primary rounded-pill badges-office">0</span>        
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../user/user.php" target_div="display">
        ผู้ใช้งาน
        <span class="badge bg-primary rounded-pill badges-user">0</span>        
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../user/user_pending.php" target_div="display">
        ผู้ใช้งานรอการอนุมัติ
        <span class="badge bg-primary rounded-pill badges-user_pending">0</span>        
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../user/user_cancel.php" target_div="display">
        ผู้ใช้งานที่ยกเลิกแล้ว
        <span class="badge bg-primary rounded-pill badges-user_cancel">0</span>    
    </a>
</div>
<br>
<b>รหัสโปรแกรม</b>
<div class="list-group pt-3 p-1 list-group-flush" style="width:240px;">
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/climate.php" target_div="display">
        สภาพอากาศ
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/office_type.php" target_div="display">
        ประเภทหน่วยงาน
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/position.php" target_div="display">
        ตำแหน่ง
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/position_level.php" target_div="display">
        ระดับ
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/road_style.php" target_div="display">
        ลักษณะถนน
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/road.php" target_div="display">
        ประเภทถนน
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/user_status.php" target_div="display">
        สถานะผู้ใช้งาน
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/user_type.php" target_div="display">
        ประเภทผู้ใช้งาน
    </a>
    <a href="#" class="list-group-item list-group-item-action navbar-btn d-flex justify-content-between align-items-center" show_type="page" layout=""
        page="../code/vehicle_type.php" target_div="display">
        ประเภทยานพาหนะ
    </a>
</div>
<script>
    $(function(){
        updateAdminBadges();
    })

    function updateAdminBadges(){
        $.ajax({method: "POST", url: "../sidebar/admin_ajax.php"}).done(function (msg) {
            var badges_data=JSON.parse(msg);
            console.log(badges_data);
            $(".badges-office").html(badges_data.office[0].count_all);
            var user_count_all=0;
            $.each(badges_data.user, function( index, value ) {
                user_count_all+=parseInt(value.count_all);
                switch (value.user_status_id) {
                    case "1":
                        $(".badges-user_pending").html(value.count_all);
                        break;
                    case "2":
                        $(".badges-user_ready").html(value.count_all);
                        break;
                    case "3":
                        $(".badges-user_cancel").html(value.count_all);
                        break;
                }
                $(".badges-user").html(user_count_all);
            });

        });
    }
</script>   