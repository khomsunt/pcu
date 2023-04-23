function loadPage(url, target, params = {}) {
    $("#" + target).html('<div class="d-flex justify-content-center p-1"><div class="spinner-border text-primary" role=" status "></div></div>');
    $.ajax({method: "POST", url: url, data: params}).done(function (msg) {
        $("#" + target).html(msg);
    });
}

function setCurrentPage(url, target, params = {}) {
    params.target_div = target;
    params.url = url;
    $.ajax({method: "POST", url: "../main/set_current_page.php", data: params}).done(function (msg) { // console.log(msg);
    });
}

function getCurrentPage() {
    $.ajax({method: "POST", url: "../main/get_current_page.php"}).done(function (msg) {
        console.log(msg);
    });
}
