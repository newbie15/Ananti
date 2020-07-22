$(document).ajaxStart(function () {
    $(".hload").show();
    $(".loader").show();
});
$(document).ajaxComplete(function () {
    $(".hload").hide();
    $(".loader").hide();
});

var url = window.location.href;
console.log(url);

var x = url.split("/");
console.log(x);

var GOTO = x[0] + "//" + x[2] + "/" + x[3] + "/"; // "http://10.23.3.101/MDP/";
// console.log(BASE_URL);

$.ajax({
    method: "GET",
    url: GOTO + "login/cek_session",
}).done(function (msg) {
    console.log(msg);
    if (msg == "?") {
        window.location.replace(GOTO + "login");
    }
});
