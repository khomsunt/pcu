<div class="container-fluid">
    <h3 class="pt-2">ทะเบียนหน่วยงาน</h3>

    <div class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
            <div class="fw-bold">Subheading</div>
            Content for list item
        </div>
        <span class="badge bg-primary rounded-pill">14</span>
    </div>


    <table id="office-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Office code</th>
                <th>Office name</th>
                <th>Office type code</th>
                <th>Tambon code</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Office code</th>
                <th>Office name</th>
                <th>Office type code</th>
                <th>Tambon code</th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
<script>
$(function() {
    $('#office-table').DataTable({
        retrieve: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: {
            url: '../office/office_ajax.php',
        },
        columnDefs: [{
                targets: 0,
                "searchable": false,
                data: 'office_code'
            },
            {
                targets: 1,
                "searchable": false,
                data: 'office_name'
            },
            {
                targets: 2,
                "searchable": false,
                data: 'office_type_code'
            },
            {
                targets: 3,
                "searchable": false,
                data: 'tambon_code'
            },
            {
                targets: 4,
                data: null,
                defaultContent: "<button class='btn btn-sm btn-primary row-edit-btn'>แก้ไข</button>",
            },
            {
                targets: 5,
                data: null,
                defaultContent: "<button class='btn btn-sm btn-primary row-delete-btn'>ลบ</button>",
            },
        ],
    });
})
</script>