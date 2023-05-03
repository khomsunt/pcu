<script>
$(function() {
    loadPage("", "../sidebar/admin.php", "sidebar",current_page['params']);
    if (current_page['page'] && current_page['target_div']) {
        loadPage("", current_page['page'], current_page['target_div'],current_page['params']);
    } else {
        loadPage("", "../office/office.php", "display",current_page['params']);
    }

})
</script>
