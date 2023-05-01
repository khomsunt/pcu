<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนปรเภทถนน</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="road-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 road-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 road-add-btn"><i class="bi bi-plus-circle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-info mx-1 road-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 road-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var road_id;
var road_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    road_table = $('#road-table').DataTable({
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
            url: '../code/road_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('road_id', data['road_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                searchable: true,
                data: 'road_id'
            },
            {
                targets: 1,
                searchable: true,
                data: 'road_name'
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 road-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 road-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    road_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            road_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    road_table.on('draw',function(){
        // console.log(road_table.page());
        // console.log(road_table.order());
        // console.log(road_table.search());
        datatable_current_page=road_table.page();
    })

    $(document).on("click touchstart", ".road-edit-btn", function(e) {
        loadPopup("../code/road_edit.php",{"road_id":$(this).parents('tr').attr("road_id"),"page":road_table.page(),"redirect_url":"../code/road.php"});
    });

    $(document).on("click touchstart", ".road-add-btn", function(e) {
        loadPopup("../code/road_edit.php",{"redirect_url":"../code/road.php"});
    });

    $(document).on("click touchstart", ".road-refresh-btn", function(e) {
        loadPage("","../code/road.php","display");
    });

    $(document).on("click touchstart", ".road-delete-btn", function(e) {
        road_id=$(this).parents('tr').attr("road_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../code/road_delete.php", data: {road_id: road_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../code/road.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>