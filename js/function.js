function loadPage(url, target, params = {}) {
    $("#" + target).html('<div class="d-flex justify-content-center p-1"><div class="spinner-border text-primary" role=" status "></div></div>');
    $.ajax({method: "POST", url: url, data: params}).done(function (msg) {
        $("#" + target).html(msg);
    });
}
