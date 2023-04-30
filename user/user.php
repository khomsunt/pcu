<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนผู้ใช้งาน</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="user-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ-นามสกุ</th>
                <th>ตำแหน่ง</th>
                <th>ระดับ</th>
                <th>หน่วยงาน</th>
                <th>ประเภทผู้ใช้งาน</th>
                <th>สถานะผู้ใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 user-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 user-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ-นามสกุ</th>
                <th>ตำแหน่ง</th>
                <th>ระดับ</th>
                <th>หน่วยงาน</th>
                <th>ประเภทผู้ใช้งาน</th>
                <th>สถานะผู้ใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 user-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 user-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var user_id;
var user_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    user_table = $('#user-table').DataTable({
        retrieve: true,
        dom: 'Bfrtip',

        processing: true,
        serverSide: true,
        pageLength: pageLength,

        searching: true,
        lengthChange:true,
        orderCellsTop: true,
        fixedHeader: true,
        select: true,

        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

	    ajax: $.fn.dataTable.pipeline({
            url: '../user/user_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('user_id', data['user_id']);
        },  

        columnDefs: [
            {
                targets: 0,
                data: null,
                render: function (data, type, row, meta) {
                    datatable_current_page=user_table.page();
                    return (pageLength * datatable_current_page) + meta.row + 1;
                }                
            },
            {
                targets: 1,
                searchable: true,
                data: 'user_name'
            },
            {
                targets: 2,
                searchable: true,
                data: 'position_name'
            },
            {
                targets: 3,
                searchable: false,
                data: 'position_level_name'
            },
            {
                targets: 4,
                searchable: true,
                data: 'office_name'
            },
            {
                targets: 5,
                searchable: true,
                data: 'user_type_name'
            },
            {
                targets: 6,
                searchable: true,
                data: 'user_status_name'
            },
            {
                targets: 7,
                data: null,
                orderable: false,
                defaultContent: '<div class="btn-group">'+
                    '<button type="button" class="btn btn-sm btn-warning mx-1 user-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 user-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    user_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            user_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    user_table.on('draw',function(){
        // console.log(user_table.page());
        // console.log(user_table.order());
        // console.log(user_table.search());
        datatable_current_page=user_table.page();
    })

    $(document).on("click touchstart", ".user-edit-btn", function(e) {
        loadPopup("../user/user_edit.php",{"user_id":$(this).parents('tr').attr("user_id"),"page":user_table.page()});
    });

    $(document).on("click touchstart", ".user-add-btn", function(e) {
        loadPopup("../user/user_edit.php");
    });

    $(document).on("click touchstart", ".user-refresh-btn", function(e) {
        loadPage("","../user/user.php","display");
    });

    $(document).on("click touchstart", ".user-delete-btn", function(e) {
        user_id=$(this).parents('tr').attr("user_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../user/user_delete.php", data: {user_id: user_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../user/user.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>