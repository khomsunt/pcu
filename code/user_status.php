<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนรหัสสถานะผู้ใช้งาน</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="user_status-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 user_status-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 user_status-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 user_status-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 user_status-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var user_status_id;
var user_status_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    user_status_table = $('#user_status-table').DataTable({
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
            url: '../code/user_status_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('user_status_id', data['user_status_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                searchable: true,
                data: 'user_status_id'
            },
            {
                targets: 1,
                searchable: true,
                data: 'user_status_name'
            },
            {
                targets: 2,
                searchable: false,
                data: 'status_name'
            },
            {
                targets: 3,
                data: null,
                orderable: false,
                defaultContent: '<div class="btn-group">'+
                    '<button type="button" class="btn btn-sm btn-warning mx-1 user_status-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 user_status-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    user_status_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            user_status_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    user_status_table.on('draw',function(){
        // console.log(user_status_table.page());
        // console.log(user_status_table.order());
        // console.log(user_status_table.search());
        datatable_current_page=user_status_table.page();
    })

    $(document).on("click touchstart", ".user_status-edit-btn", function(e) {
        loadPopup("../code/user_status_edit.php",{"user_status_id":$(this).parents('tr').attr("user_status_id"),"page":user_status_table.page(),"redirect_url":"../code/user_status.php"});
    });

    $(document).on("click touchstart", ".user_status-add-btn", function(e) {
        loadPopup("../code/user_status_edit.php",{"redirect_url":"../code/user_status.php"});
    });

    $(document).on("click touchstart", ".user_status-refresh-btn", function(e) {
        loadPage("","../code/user_status.php","display");
    });

    $(document).on("click touchstart", ".user_status-delete-btn", function(e) {
        user_status_id=$(this).parents('tr').attr("user_status_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../code/user_status_delete.php", data: {user_status_id: user_status_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../code/user_status.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>