<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนรหัสตำแหน่ง</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="position-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 position-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 position-add-btn"><i class="bi bi-plus-circle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-info mx-1 position-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 position-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var position_id;
var position_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    position_table = $('#position-table').DataTable({
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
            url: '../code/position_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('position_id', data['position_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                searchable: true,
                data: 'position_id'
            },
            {
                targets: 1,
                searchable: true,
                data: 'position_name'
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 position-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 position-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    position_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            position_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    position_table.on('draw',function(){
        // console.log(position_table.page());
        // console.log(position_table.order());
        // console.log(position_table.search());
        datatable_current_page=position_table.page();
    })

    $(document).on("click touchstart", ".position-edit-btn", function(e) {
        loadPopup("../code/position_edit.php",{"position_id":$(this).parents('tr').attr("position_id"),"page":position_table.page(),"redirect_url":"../code/position.php"});
    });

    $(document).on("click touchstart", ".position-add-btn", function(e) {
        loadPopup("../code/position_edit.php",{"redirect_url":"../code/position.php"});
    });

    $(document).on("click touchstart", ".position-refresh-btn", function(e) {
        loadPage("","../code/position.php","display");
    });

    $(document).on("click touchstart", ".position-delete-btn", function(e) {
        position_id=$(this).parents('tr').attr("position_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../code/position_delete.php", data: {position_id: position_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../code/position.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>