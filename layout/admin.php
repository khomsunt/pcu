<script>
$(function() {
    loadPage("", "../sidebar/admin.php", "sidebar");
    if (current_page['page'] && current_page['target_div']) {
        loadPage("", current_page['page'], current_page['target_div']);
    } else {
        loadPage("", "../office/office.php", "display");
    }

})
</script>