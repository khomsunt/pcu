<div class="container-fluid">
    <div class="row">
        <div id="topbar" class="col-12">
        </div>
    </div>
    <div class="row">
        <div id="sidebar" class="col-3"></div>
        <div id="display" class="col-9"></div>
    </div>
</div>

<script>
$(function() {
    loadPage("../main/topbar.php", "topbar");
    loadPage("../main/sidebar.php", "sidebar");
    loadPage("../main/dashbord.php", "display");
})
</script>
