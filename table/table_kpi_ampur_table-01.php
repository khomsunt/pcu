<table id="myTable01" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<script>
$(function() {
    $('#myTable01').DataTable({
        retrieve: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: {
            url: '../table/table_kpi_ampur_table-01_ajax.php',
        },
        columnDefs: [{
                targets: 0,
                "searchable": false,
                data: 'Name'
            },
            {
                targets: 1,
                "searchable": false,
                data: 'Position'
            },
            {
                targets: 2,
                "searchable": false,
                data: 'Office'
            },
            {
                targets: 3,
                "searchable": false,
                data: 'Age'
            },
            {
                targets: 4,
                "searchable": false,
                data: 'StartDate'
            },
            {
                targets: 5,
                "searchable": false,
                data: 'Salary'
            },
            {
                targets: 6,
                data: null,
                defaultContent: "<button class='btn btn-sm btn-primary row-edit-btn'>แก้ไข</button>",
            },
            {
                targets: 7,
                data: null,
                defaultContent: "<button class='btn btn-sm btn-primary row-delete-btn'>ลบ</button>",
            },
        ],
    });
})
</script>
