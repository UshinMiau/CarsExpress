$(function() {

    slideFilters();

    $(window).resize(function(){
        location.reload();
    });

    function slideFilters() {
        var rotateChevron = false;
        
        if($(window).width() <= 768) {
            $('aside.vehicle-showcase__filters > h1').on('click', function() {
                $('aside.vehicle-showcase__filters form').slideToggle();
                
                if(!rotateChevron) {
                    $('aside.vehicle-showcase__filters > h1 > i').css('rotate', '180deg');
                    rotateChevron = true;
                }
                else {
                    $('aside.vehicle-showcase__filters > h1 > i').css('rotate', '0deg');
                    rotateChevron = false;
                }
            });
        }
    }
        
});