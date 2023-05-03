<!doctype html>
<html lang="en">
<?php
$v = date("YmdHis");
include "../user/get_profile_data.php";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="../css/main.css?v=<?php echo $v; ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/2.2.1/chartjs-plugin-annotation.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrspFTB0_6fco5mPwD416MkStMgCXubE">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script src="../js/function.js?v=<?php echo $v; ?>"></script>

    <script>
    <?php
if (isset($_SESSION['current_page'])) {
    ?>
    var current_page = <?php echo json_encode($_SESSION['current_page']); ?>;
    <?php
} else {
    ?>
    var current_page = [];
    current_page['layout'] = "";
    current_page['page'] = "";
    current_page['target_div'] = "";
    current_page['params']={};
    <?php
}?>
    var user_profile = <?php echo json_encode($user_profile); ?>;
    var user_profile_fullscreen_obj = _.find(user_profile, 'user_profile_key', 'fullscreen');
    var user_profile_fullscreen = (user_profile_fullscreen_obj) ? user_profile_fullscreen_obj.user_profile_value : "0";
    </script>


</head>

<body>
    <div id="root"></div>

    <div class="modal fade" id="popup-main" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup-confirm-delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">โปรดยืนยัน!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">คุณต้องการลบข้อมูลนี้หรือไม่ ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning delete-cancel-btn" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-danger delete-ok-btn">ตกลง</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup-server-err" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แจ้งเตือน!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">เกิดข้อผิดพลาด ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้ โปรดติดต่อผู้ดูแลระบบ</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">ตกลง</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
    $(function() {
        loadPage("", "../template/default.php", "root");
    })
    </script>
</body>

</html>