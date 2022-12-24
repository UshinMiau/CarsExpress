$(function() {
    
    menuMobile();
    openModalWindow();
    closeModalWindow();
    changeModalWindowFormLogin();
    changeModalWindowProfile();

    function menuMobile(){
        $('article.menu__mobile-navigation-icon').on('click', function(){
            $('nav.menu-mobile').slideToggle();
        });
    }

    function openModalWindow() {
        $('a#login, a#profile').on('click', function(e){
            $('.overlay')
                .css('display', 'flex')
                .fadeIn();
            e.stopPropagation();
        });

        $('.overlay section').on('click',function(e){
            e.stopPropagation();
        });
    }

    function closeModalWindow(){
        var closingElements = $('body,.close-modal-window-button');

        closingElements.on('click', function(){
            $('.overlay').fadeOut();
        });
    };

    function changeModalWindowProfile() {
        $('a#profile-data__add-vehicle').on('click', function(){
            $('section.profile-data').hide();
            $('section.add-vehicle').show();
        });

        // ! COLOCAR CLIQUE PARA VOLTAR AO PERFIL
    }

    function changeModalWindowFormLogin(){
        $('a#sign_up').on('click', function(){
            $('article.form-login__sign-in').css('display', 'none'); 
            $('article.form-login__sign-up').css('display', 'flex');
        });

        $('a#sign_in').on('click', function(){
            $('article.form-login__sign-up').css('display', 'none');
            $('article.form-login__sign-in').css('display', 'flex');
        });
    }

});