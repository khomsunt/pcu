var current_page = [];
current_page['layout'] = "";
current_page['page'] = "";
current_page['target_div'] = "";

function loadPage(layout, page, target, params = {}) {
    $("#" + target).html('<div class="d-flex justify-content-center p-1"><div class="spinner-border text-primary" role=" status "></div></div>');

    if (current_page['layout'] === layout || layout === '') {
        $.ajax({method: "POST", url: page, data: params}).done(function (msg) {
            $("#" + target).html(msg);
        });
    } else {
        params.page = page;
        $.ajax({method: "POST", url: layout, data: params}).done(function (msg) {
            $("#" + target).html(msg);
        });
    }
}

function setCurrentPage(layout, page, target, params = {}) {
    params.target_div = target;
    params.layout = layout;
    params.page = page;
    current_page['layout'] = (layout) ? layout : current_page['layout'];
    current_page['page'] = page;
    current_page['target_div'] = target;
    $.ajax({method: "POST", url: "../main/set_current_page.php", data: params}).done(function (msg) { // console.log(msg);
    });
}

function getCurrentPage() {
    $.ajax({method: "POST", url: "../main/get_current_page.php"}).done(function (msg) {
        console.log(msg);
    });
}

function setActiveSidebar(this_btn) {
    $(".navbar-btn").removeClass("active");
    $(this_btn).addClass("active");
}
