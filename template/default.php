<div class="container-fluid">
    <div class="row">
        <div id="topbar" class="col-12">
        </div>
    </div>
    <div class="row" style="margin:0; padding:0;">
        <div id="sidebar" class="col-sm-2 col-auto px-0 collapse show collapse-horizontal overflow-hidden" style="margin:0; padding:0;"></div>
        <div id="display" class="col-sm col border-start ps-md-2 pt-2" style="margin:0; padding:0;"></div>
    </div>
</div>

<script>
$(function() {
    loadPage("../main/topbar.php", "topbar");
    loadPage("../main/sidebar.php", "sidebar");
    loadPage("../main/dashbord.php", "display");
})
</script>
