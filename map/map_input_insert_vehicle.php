<div class="container-fluid">
    <table id="vehicle-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ</th>
                <th>ประเภทรถ</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 vehicle-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 vehicle-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </thead>
    </table>
</div>

<?php
print_r($_POST);
?>
<script src="../js/datatable_pipeline.js"></script>

<script>
var vehicle_id;
var vehicle_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    vehicle_table = $('#vehicle-table').DataTable({
        retrieve: true,

        processing: true,
        serverSide: true,

        searching: false,
        lengthChange:true,
        fixedHeader: true,
        dom: 'r',

	    ajax: $.fn.dataTable.pipeline({
            url: '../map/vehicle_ajax.php',
            data: {"accident_id":<?php echo $_POST['accident_id']; ?>}
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('vehicle_id', data['vehicle_id']);
        },  

        columnDefs: [
            {
                targets: 0,
                orderable: false,
                data: null,
                render: function (data, type, row, meta) {
                    datatable_current_page=vehicle_table.page();
                    return (pageLength * datatable_current_page) + meta.row + 1;
                }                
            },
            {
                targets: 1,
                orderable: false,
                data: 'first_name'
            },
            {
                targets: 2,
                orderable: false,
                data: 'last_name'
            },
            {
                targets: 3,
                orderable: false,
                data: null,
                defaultContent: '<div class="btn-group">'+
                    '<button type="button" class="btn btn-sm btn-warning mx-1 vehicle-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 vehicle-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    vehicle_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            vehicle_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    vehicle_table.on('draw',function(){
        // console.log(victim_table.page());
        // console.log(victim_table.order());
        // console.log(victim_table.search());
        datatable_current_page=vehicle_table.page();
    })

    $(document).on("click touchstart", ".vehicle-edit-btn", function(e) {
        loadPopup("../vehicle/vehicle_edit.php",{"vehicle_id":$(this).parents('tr').attr("vehicle_id"),"page":vehicle_table.page(),"redirect_url":"../vehicle/vehicle.php"});
    });

    $(document).on("click touchstart", ".vehicle-add-btn", function(e) {
        loadSubPopup("../map/vehicle_edit.php",{"accident_id":$("#accident_id").val()});
    });

    $(document).on("click touchstart", ".vehicle-refresh-btn", function(e) {
        loadPage("","../vehicle/vehicle.php","display");
    });

    $(document).on("click touchstart", ".vehicle-delete-btn", function(e) {
        vehicle_id=$(this).parents('tr').attr("vehicle_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../vehicle/vehicle_delete.php", data: {vehicle_id: vehicle_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../vehicle/vehicle.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>