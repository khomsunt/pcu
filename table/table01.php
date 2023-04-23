<table id="myTable01" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
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
        </tr>
    </tfoot>
</table>
<script>
$(function() {
    $('#myTable01').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: {
            url: '../table/table01_ajax.php',
        },
        columns: [{
                data: 'Name'
            },
            {
                data: 'Position'
            },
            {
                data: 'Office'
            },
            {
                data: 'Age'
            },
            {
                data: 'StartDate'
            },
            {
                data: 'Salary'
            },
        ],
    });
})
</script>
