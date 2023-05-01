<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนรหัสระดับ</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="position_level-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 position_level-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 position_level-add-btn"><i class="bi bi-plus-circle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-info mx-1 position_level-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 position_level-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var position_level_id;
var position_level_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    position_level_table = $('#position_level-table').DataTable({
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
            url: '../code/position_level_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('position_level_id', data['position_level_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                searchable: true,
                data: 'position_level_id'
            },
            {
                targets: 1,
                searchable: true,
                data: 'position_level_name'
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 position_level-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 position_level-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    position_level_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            position_level_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    position_level_table.on('draw',function(){
        // console.log(position_level_table.page());
        // console.log(position_level_table.order());
        // console.log(position_level_table.search());
        datatable_current_page=position_level_table.page();
    })

    $(document).on("click touchstart", ".position_level-edit-btn", function(e) {
        loadPopup("../code/position_level_edit.php",{"position_level_id":$(this).parents('tr').attr("position_level_id"),"page":position_level_table.page(),"redirect_url":"../code/position_level.php"});
    });

    $(document).on("click touchstart", ".position_level-add-btn", function(e) {
        loadPopup("../code/position_level_edit.php",{"redirect_url":"../code/position_level.php"});
    });

    $(document).on("click touchstart", ".position_level-refresh-btn", function(e) {
        loadPage("","../code/position_level.php","display");
    });

    $(document).on("click touchstart", ".position_level-delete-btn", function(e) {
        position_level_id=$(this).parents('tr').attr("position_level_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../code/position_level_delete.php", data: {position_level_id: position_level_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../code/position_level.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>