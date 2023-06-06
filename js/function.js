$(function () {
    $("body").tooltip({selector: '[data-toggle=tooltip]'});
});

function loadPage(layout, page, target, params = {}) {
    console.log("loadpage params=", params);
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

function loadPopup(url, params = {}) {
    $("#popup-main").modal("show");
    $("#popup-main .modal-content").html('<div class="d-flex justify-content-center p-1"><div class="spinner-border text-primary" role=" status "></div></div>');
    $.ajax({method: "POST", url: url, data: params}).done(function (msg) {
        $("#popup-main .modal-content").html(msg);
    });
}

function loadSubPopup(url, params = {}) {
    console.log("loadSubPopup params=",params);
    $("#popup-sub").modal("show");
    $("#popup-sub .modal-content").html('<div class="d-flex justify-content-center p-1"><div class="spinner-border text-primary" role=" status "></div></div>');
    $.ajax({method: "POST", url: url, data: params}).done(function (msg) {
        $("#popup-sub .modal-content").html(msg);
    });
}

function setCurrentPage(layout, page, target, params = {}) {
    layout = (layout) ? layout : current_page['layout'];
    params.target_div = target;
    params.layout = layout;
    params.page = page;
    current_page['layout'] = layout;
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

function setProfile(key, value, params = {}) {
    params.user_profile_key = key;
    params.user_profile_value = value;
    $.ajax({method: "POST", url: "../user/set_profile.php", data: params}).done(function (msg) {
        console.log(msg);
    });
}

function arrayKeySearch(_array, _key, _value, _search_key) {
    Object.keys(_array).forEach(function (name) { // console.log(_array[name]);
        console.log(_array[name][_key]);

        if (_search_key === _array[name][_key]) {
            console.log(_array[name][_value]);

            return _array[name][_value];
        }
    });
}
