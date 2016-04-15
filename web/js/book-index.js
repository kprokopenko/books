$(function () {
    // Модальное окно с просмотром изображения
    $('.preview-button').click(function (e) {
        var src = $(this).attr("src"),
            h = this.naturalHeight < 500 ? this.naturalHeight : 500,
            w = this.naturalWidth < 550 ? this.naturalWidth : 550;

        $("#preview-modal").find("img").attr("src", src).end()
            .dialog('option', 'height', h + 60)
            .dialog('option', 'width', w + 35)
            .dialog('open');
    });

    // Модальное окно просмотра
    $('.ajax-view').click(function (e) {
        e.preventDefault();

        var ajaxUrl = $(this).attr('href');
        $('#view-ajax-modal').load(ajaxUrl).dialog('open');
    });
});
