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

var GOTO = SITE_URL;
// console.log(BASE_URL);

var modify = false;

$.ajax({
    method: "GET",
    url: GOTO + "login/cek_session",
}).done(function (msg) {
    console.log(msg);
    if (msg == "?") {
        window.location.replace(GOTO + "login");
    }
});

$(window).bind('beforeunload', function(){
    if(modify){
        return 'Are you sure you want to leave?\nYou have unsaved document';
    }
});

function jexcel_diubah(){
    modify = true;
}

function jexcel_disimpan(){
    modify = false;
}