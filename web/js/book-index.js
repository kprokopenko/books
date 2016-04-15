$(function () {
    $('.preview-button').click(function (e) {
        var src = $(this).attr("src"),
            h = this.naturalHeight < 500 ? this.naturalHeight : 500,
            w = this.naturalWidth < 550 ? this.naturalWidth : 550;

        $("#preview-modal").find("img").attr("src", src).end()
            .dialog('option', 'height', h + 60)
            .dialog('option', 'width', w + 35)
            .dialog('open');
    })
});
