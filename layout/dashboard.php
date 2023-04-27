<script>
$(function() {
    loadPage("", "../sidebar/dashboard.php", "sidebar");
    if (current_page['page'] && current_page['target_div']) {
        loadPage("", current_page['page'], current_page['target_div']);
    } else {
        loadPage("", "../dashboard/dashboard.php", "display");
    }
})
</script>