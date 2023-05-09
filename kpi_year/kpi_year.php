<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start pt-3">
        <div class="ms-2 me-auto">
            <div class="fw-bold h3">ทะเบียนหน่วยงาน</div>
        </div>
        <span class="px-3">
        </span>
    </div>

    <table id="office-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>Office code</th>
                <th>Office name</th>
                <th>Office type code</th>
                <th>Tambon code</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 office-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 office-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ลำดับที่</th>
                <th>Office code</th>
                <th>Office name</th>
                <th>Office type code</th>
                <th>Tambon code</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 office-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 office-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var office_id;
var office_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    office_table = $('#office-table').DataTable({
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
            url: '../office/office_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('office_id', data['office_id']);
        },  

        initComplete: function (settings, json) {
            console.log("json=",json);
            updateAdminBadges();
        },

        columnDefs: [
            {
                targets: 0,
                data: null,
                render: function (data, type, row, meta) {
                    datatable_current_page=office_table.page();
                    return (pageLength * datatable_current_page) + meta.row + 1;
                }                
            },
            {
                targets: 1,
                searchable: true,
                data: 'office_code'
            },
            {
                targets: 2,
                searchable: true,
                data: 'office_name'
            },
            {
                targets: 3,
                searchable: false,
                data: 'office_type_name'
            },
            {
                targets: 4,
                searchable: true,
                data: 'tambon_name'
            },
            {
                targets: 5,
                data: null,
                orderable: false,
                defaultContent: '<div class="btn-group">'+
                    '<button type="button" class="btn btn-sm btn-warning mx-1 office-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 office-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    office_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            office_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    office_table.on('draw',function(){
        // console.log(office_table.page());
        // console.log(office_table.order());
        // console.log(office_table.search());
        datatable_current_page=office_table.page();
    })

    $(document).on("click touchstart", ".office-edit-btn", function(e) {
        loadPopup("../office/office_edit.php",{"office_id":$(this).parents('tr').attr("office_id"),"page":office_table.page()});
    });

    $(document).on("click touchstart", ".office-add-btn", function(e) {
        loadPopup("../office/office_edit.php");
    });

    $(document).on("click touchstart", ".office-refresh-btn", function(e) {
        loadPage("","../office/office.php","display");
    });

    $(document).on("click touchstart", ".office-delete-btn", function(e) {
        office_id=$(this).parents('tr').attr("office_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../office/office_delete.php", data: {office_id: office_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../office/office.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>