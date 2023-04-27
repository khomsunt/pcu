<script>
$(function() {
    loadPage("", "../sidebar/map_input.php", "sidebar");
    if (current_page['page'] && current_page['target_div']) {
        loadPage("", current_page['page'], current_page['target_div']);
    } else {
        loadPage("", "../map/map_input.php", "display");
    }
})
</script>