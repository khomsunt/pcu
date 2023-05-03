<script>
$(function() {
    loadPage("", "../sidebar/map_input.php", "sidebar",current_page['params']);
    if (current_page['page'] && current_page['target_div']) {
        loadPage("", current_page['page'], current_page['target_div'],current_page['params']);
    } else {
        loadPage("", "../map/map_input.php", "display",current_page['params']);
    }
})
</script>