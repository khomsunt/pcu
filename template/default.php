<div class="container-fluid p-0">
    <div class="row" style="margin:0; padding:0;">
        <div id="topbar" class="col-12 shadow"></div>
        <div id="sidebar" class="col-sm-2 col-auto pt-5 px-0 collapse show collapse-horizontal overflow-hidden"
            style="margin:0; padding:0; overflow:auto;"></div>
        <div id="display" class="col-sm col pt-5 border-start bg-light overflow-auto" style="margin:0; padding:0;">
        </div>
    </div>
</div>

<script>
$(function() {
    loadPage("../main/topbar.php", "topbar");
    loadPage("../main/sidebar.php", "sidebar");
    loadPage("../main/dashbord.php", "display");
})
</script>
