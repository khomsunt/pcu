<div class="container-fluid">
    <table id="accident_site-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ</th>
                <th>ประเภทรถ</th>
                <th>            
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info mx-1 accident_site-refresh-btn"><i class="bi bi-arrow-repeat"></i></button>
                        <button type="button" class="btn btn-sm btn-success mx-1 accident_site-add-btn"><i class="bi bi-plus-circle"></i></button>
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
var accident_site_id;
var accident_site_table;
var datatable_current_page=0;
var pageLength=10;
$(function() {
    accident_site_table = $('#accident_site-table').DataTable({
        retrieve: true,

        processing: true,
        serverSide: true,

        searching: false,
        lengthChange:true,
        fixedHeader: true,
        dom: 'r',

	    ajax: $.fn.dataTable.pipeline({
            url: '../map/accident_site_ajax.php',
            data: {"accident_id":<?php echo $_POST['accident_id']; ?>}
        }),

        createdRow: function( row, data, dataIndex ) {
            $(row).attr('accident_site_id', data['accident_site_id']);
        },  

        columnDefs: [
            {
                targets: 0,
                orderable: false,
                data: null,
                render: function (data, type, row, meta) {
                    datatable_current_page=accident_site_table.page();
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
                    '<button type="button" class="btn btn-sm btn-warning mx-1 accident_site-edit-btn"><i class="bi bi-pen-fill"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-danger mx-1 accident_site-delete-btn"><i class="bi bi-trash3-fill"></i></button>'+
                '</div>',
            },
        ],
    });
    
    accident_site_table.on('init.dt', function (e) {
        <?php 
        if (isset($_POST['page'])){
            ?>
            accident_site_table.page( <?php echo $_POST['page']; ?> ).draw('page');
            <?php
        }?>
    });

    accident_site_table.on('draw',function(){
        // console.log(victim_table.page());
        // console.log(victim_table.order());
        // console.log(victim_table.search());
        datatable_current_page=accident_site_table.page();
    })

    $(document).on("click touchstart", ".accident_site-edit-btn", function(e) {
        loadPopup("../accident_site/accident_site_edit.php",{"accident_site_id":$(this).parents('tr').attr("accident_site_id"),"page":accident_site_table.page(),"redirect_url":"../accident_site/accident_site.php"});
    });

    $(document).on("click touchstart", ".accident_site-add-btn", function(e) {
        loadSubPopup("../map/accident_site_edit.php",{"accident_id":$("#accident_id").val()});
    });

    $(document).on("click touchstart", ".accident_site-refresh-btn", function(e) {
        loadPage("","../accident_site/accident_site.php","display");
    });

    $(document).on("click touchstart", ".accident_site-delete-btn", function(e) {
        accident_site_id=$(this).parents('tr').attr("accident_site_id");
        $("#popup-confirm-delete").modal("show");
    });

    $("#popup-confirm-delete").on("click touchstart", ".delete-ok-btn", function(e) {
        $.ajax({method: "POST", url: "../accident_site/accident_site_delete.php", data: {accident_site_id: accident_site_id}}).done(function (msg) {
            if (msg=='1'){
                $("#popup-confirm-delete").modal("hide");
                loadPage("","../accident_site/accident_site.php","display");
            }else{
                $("#popup-confirm-delete").modal("hide");
                $("#popup-server-error").modal("show");
            }
        });
    });

})
</script>