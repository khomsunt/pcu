<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select u.*,concat(ifnull(u.prename,''),ifnull(u.user_first_name,''),' ',ifnull(u.user_last_name,'')) as user_name,p.position_name,pl.position_level_name,o.office_name,ut.user_type_name,us.user_status_name from `user` u left join position p on u.position_id=p.position_id left join position_level pl on u.position_level_id=pl.position_level_id left join office o on u.office_id=o.office_id left join user_type ut on u.user_type_id=ut.user_type_id left join user_status us on u.user_status_id=us.user_status_id where u.user_id=:user_id";

$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['user_id' => $_SESSION['user_id_' . $config['projectname']]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div class="modal-header">
    <h5 class="modal-title modal-label">ข้อมูลส่วนตัว</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-12 text-center">
                    <img src="<?php echo $user['picture']; ?>" class="card-img-top" alt="...">
                    <p class="card-text pt-2">
                        <?php echo $user['prename'] . $user['user_first_name'] . " " . $user['user_last_name']; ?>
                    </p>
                </div>
                <div class="col-lg-8 col-12">

                    <div class="ms-2 me-auto py-1">
                        <div class="fw-bold">ชื่อ-นามสกุล</div><?php echo $user['user_name']; ?>
                    </div>
                    <div class="ms-2 me-auto py-1">
                        <div class="fw-bold">เลขบัตรประชาชน</div><?php echo $user['cid']; ?>
                    </div>
                    <div class="ms-2 me-auto py-1">
                        <div class="fw-bold">ตำแหน่ง</div><?php echo $user['position_name']." ".$user['position_level_name']; ?>
                    </div>
                    <div class="ms-2 me-auto py-1">
                        <div class="fw-bold">หน่วยงาน</div><?php echo $user['office_name']; ?>
                    </div>
                    <div class="ms-2 me-auto py-1">
                        <div class="fw-bold">กลุ่มผู้ใช้งาน</div><?php echo $user['user_type_name']; ?>
                    </div>
                    <div class="ms-2 me-auto py-1">
                        <div class="fw-bold">สถานะผู้ใช้งาน</div><?php echo $user['user_status_name']; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>