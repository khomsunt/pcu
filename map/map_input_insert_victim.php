<div class="container-fluid">
    <table id="victim-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 victim-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 victim-add-btn"><i class="bi bi-plus-circle"></i></button>
                    </div>
                </th>
            </tr>
        </thead>
    </table>
</div>
<script src="../js/datatable_pipeline.js"></script>

<script>
var victim_id;
var victim_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    victim_table = $('#victim-table').DataTable({
        retrieve: true,

        processing: true,
        serverSide: true,

        searching: false,
        lengthChange:true,
        fixedHeader: true,
        dom: 'r',

	    ajax: $.fn.dataTable.pipeline({
            url: '../map/victim_ajax.php',
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('victim_id', data['victim_id']);
        },  

        columnDefs: [
            {
                targets: 0,
                orderable: false,
                data: null,
                render: function (data, type, row, meta) {
                    datatable_current_page=victim_table.page();
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 victim-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 victim-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    victim_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            victim_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    victim_table.on('draw',function(){
        // console.log(victim_table.page());
        // console.log(victim_table.order());
        // console.log(victim_table.search());
        datatable_current_page=victim_table.page();
    })

    $(document).on("click touchstart", ".victim-edit-btn", function(e) {
        loadPopup("../victim/victim_edit.php",{"victim_id":$(this).parents('tr').attr("victim_id"),"page":victim_table.page(),"redirect_url":"../victim/victim.php"});
    });

    $(document).on("click touchstart", ".victim-add-btn", function(e) {
        loadSubPopup("../map/victim_edit.php");
    });

    $(document).on("click touchstart", ".victim-refresh-btn", function(e) {
        loadPage("","../victim/victim.php","display");
    });

    $(document).on("click touchstart", ".victim-delete-btn", function(e) {
        victim_id=$(this).parents('tr').attr("victim_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../victim/victim_delete.php", data: {victim_id: victim_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../victim/victim.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>