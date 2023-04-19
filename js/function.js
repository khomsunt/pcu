function loadPage(url, target, params = {}) {
    $.ajax({method: "POST", url: url, data: params}).done(function (msg) {
        $("#" + target).html(msg);
    });
}
