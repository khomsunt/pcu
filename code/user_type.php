<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนประเภทผู้ใช้งาน</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="user_type-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 user_type-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 user_type-add-btn"><i class="bi bi-plus-circle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-info mx-1 user_type-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 user_type-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var user_type_id;
var user_type_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    user_type_table = $('#user_type-table').DataTable({
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
            url: '../code/user_type_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('user_type_id', data['user_type_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                searchable: true,
                data: 'user_type_id'
            },
            {
                targets: 1,
                searchable: true,
                data: 'user_type_name'
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 user_type-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 user_type-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    user_type_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            user_type_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    user_type_table.on('draw',function(){
        // console.log(user_type_table.page());
        // console.log(user_type_table.order());
        // console.log(user_type_table.search());
        datatable_current_page=user_type_table.page();
    })

    $(document).on("click touchstart", ".user_type-edit-btn", function(e) {
        loadPopup("../code/user_type_edit.php",{"user_type_id":$(this).parents('tr').attr("user_type_id"),"page":user_type_table.page(),"redirect_url":"../code/user_type.php"});
    });

    $(document).on("click touchstart", ".user_type-add-btn", function(e) {
        loadPopup("../code/user_type_edit.php",{"redirect_url":"../code/user_type.php"});
    });

    $(document).on("click touchstart", ".user_type-refresh-btn", function(e) {
        loadPage("","../code/user_type.php","display");
    });

    $(document).on("click touchstart", ".user_type-delete-btn", function(e) {
        user_type_id=$(this).parents('tr').attr("user_type_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../code/user_type_delete.php", data: {user_type_id: user_type_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../code/user_type.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>