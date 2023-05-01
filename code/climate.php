<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนผู้ใช้งาน</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="climate-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สถานะการใช้งาน</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 climate-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 climate-add-btn"><i class="bi bi-plus-circle"></i></button>
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
                        <button type="button" class="btn btn-sm btn-info mx-1 climate-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 climate-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var climate_id;
var climate_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    climate_table = $('#climate-table').DataTable({
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
            url: '../code/climate_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('climate_id', data['climate_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                searchable: true,
                data: 'climate_id'
            },
            {
                targets: 1,
                searchable: true,
                data: 'climate_name'
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 climate-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 climate-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    climate_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            climate_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    climate_table.on('draw',function(){
        // console.log(climate_table.page());
        // console.log(climate_table.order());
        // console.log(climate_table.search());
        datatable_current_page=climate_table.page();
    })

    $(document).on("click touchstart", ".climate-edit-btn", function(e) {
        loadPopup("../code/climate_edit.php",{"climate_id":$(this).parents('tr').attr("climate_id"),"page":climate_table.page(),"redirect_url":"../code/climate.php"});
    });

    $(document).on("click touchstart", ".climate-add-btn", function(e) {
        loadPopup("../code/climate_edit.php",{"redirect_url":"../code/climate.php"});
    });

    $(document).on("click touchstart", ".climate-refresh-btn", function(e) {
        loadPage("","../code/climate.php","display");
    });

    $(document).on("click touchstart", ".climate-delete-btn", function(e) {
        climate_id=$(this).parents('tr').attr("climate_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../code/climate_delete.php", data: {climate_id: climate_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../code/climate.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>