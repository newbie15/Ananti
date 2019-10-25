$(document).ajaxStart(function () {
    $(".hload").show();
    $(".loader").show();
});
$(document).ajaxComplete(function () {
    $(".hload").hide();
    $(".loader").hide();
});