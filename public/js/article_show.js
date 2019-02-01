//We gona add this javascript page only on the article PAGE
$(document).ready(function () {
    $('.js-like-article').on('click', function (e) {
    e.preventDefault();//that the browser doesnt follow the link

        var $link = $(e.currentTarget);// this is the link that was just click
        $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $('.js-like-article-cont').html('TEST');

    });
});