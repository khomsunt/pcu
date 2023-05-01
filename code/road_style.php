<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนลักษณะถนน</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="road_style-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 road_style-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 road_style-add-btn"><i class="bi bi-plus-circle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-info mx-1 road_style-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 road_style-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var road_style_id;
var road_style_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    road_style_table = $('#road_style-table').DataTable({
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
            url: '../code/road_style_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('road_style_id', data['road_style_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                searchable: true,
                data: 'road_style_id'
            },
            {
                targets: 1,
                searchable: true,
                data: 'road_style_name'
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 road_style-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 road_style-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    road_style_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            road_style_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    road_style_table.on('draw',function(){
        // console.log(road_style_table.page());
        // console.log(road_style_table.order());
        // console.log(road_style_table.search());
        datatable_current_page=road_style_table.page();
    })

    $(document).on("click touchstart", ".road_style-edit-btn", function(e) {
        loadPopup("../code/road_style_edit.php",{"road_style_id":$(this).parents('tr').attr("road_style_id"),"page":road_style_table.page(),"redirect_url":"../code/road_style.php"});
    });

    $(document).on("click touchstart", ".road_style-add-btn", function(e) {
        loadPopup("../code/road_style_edit.php",{"redirect_url":"../code/road_style.php"});
    });

    $(document).on("click touchstart", ".road_style-refresh-btn", function(e) {
        loadPage("","../code/road_style.php","display");
    });

    $(document).on("click touchstart", ".road_style-delete-btn", function(e) {
        road_style_id=$(this).parents('tr').attr("road_style_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../code/road_style_delete.php", data: {road_style_id: road_style_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../code/road_style.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>