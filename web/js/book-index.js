$(function () {
    $('.preview-button').click(function (e) {
        var src = $(this).attr("src");
        $("#preview-modal").find("img").attr("src", src).end().modal('show');
    })
});
