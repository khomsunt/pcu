<script>
$(function() {
    loadPage("", "../sidebar/dashboard01.php", "sidebar");
    if (current_page['page'] && current_page['target_div']) {
        loadPage("", current_page['page'], current_page['target_div']);
    } else {
        loadPage("", "../dashboard/dashboard01.php", "display");
    }

})
</script>