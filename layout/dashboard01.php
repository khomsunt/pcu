<script>
var office_level='changwat';
$(function() {
    // console.log("current_page=",current_page);
    loadPage("", "../sidebar/dashboard01.php", "sidebar",current_page['params']);
    if (current_page['page'] && current_page['target_div']) {
        loadPage("", current_page['page'], current_page['target_div'],current_page['params']);
    } else {
        loadPage("", "../dashboard/dashboard01.php", "display",current_page['params']);
    }

})
</script>