$(function() {

    $('article.vehicle-data__slider').slick({
        prevArrow: '.slick-prev',
        nextArrow: '.slick-next',
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,

        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows: false,
                }
            },
            {
                breakpoint: 601,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
            }

        ]
    });

});