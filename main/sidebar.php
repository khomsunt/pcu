<div class="sidebar-btn list-group pt-3 p-1 list-group-flush">
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/dashbord.php"
        target_div="display">Dashboard</a>
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/test.php" target_div="display">Test</a>
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/test.php"
        target_div="display">Dashboard1</a>
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/test.php"
        target_div="display">Dashboard2</a>
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/test.php"
        target_div="display">Dashboard3</a>
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/test.php"
        target_div="display">Dashboard4</a>
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/test.php"
        target_div="display">Dashboard5</a>
    <a href="#" class="list-group-item list-group-item-action" url="../dashboard/test.php"
        target_div="display">Dashboard6</a>
</div>
<script>
$(function() {
    $(document).on("click touchstart", ".sidebar-btn > a", function(e) {
        e.preventDefault();
        setActiveSidebar($(this));
        loadPage($(this).attr("url"), $(this).attr("target_div"));
        setCurrentPage($(this).attr("url"), $(this).attr("target_div"));
    });
})

function setActiveSidebar(this_btn) {
    $(".sidebar-btn > a").removeClass("active");
    $(this_btn).addClass("active");
}
</script>
