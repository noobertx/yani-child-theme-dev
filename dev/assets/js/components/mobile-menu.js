/* ------------------------------------------------------------------------ */
/*  mobile menu
/* ------------------------------------------------------------------------ */
(function($){        
    // disable touch
    console.log($('.nav-mobile'));
    if($('.nav-mobile').length > 0 ) {
        var slideout_left = new Slideout({
            'panel': document.getElementById('main-wrap'),
            'menu': document.getElementById('nav-mobile'),
            'padding': 256,
            'tolerance': 70,
            'side': 'left',
            'easing': 'cubic-bezier(.32,2,.55,.27)'
        });


        slideout_left.disableTouch();
    }

    if($('.nav-mobile').length > 0 ) {
        var slideout_right = new Slideout({
            'panel': document.getElementById('main-wrap'),
            'menu': document.getElementById('navi-user'),
            'padding': 256,
            'tolerance': 70,
            'side': 'right',
            'easing': 'cubic-bezier(.32,2,.55,.27)'
        });
        slideout_right.disableTouch();
    }

    // Toggle button
    $('.toggle-button-left, #nav-mobile .nav-link:not(.dropdown-toggle)').on('click', function () {
        slideout_left.toggle();
        $('.slideout-menu-left').toggleClass('open');
    });
    $('.toggle-button-right').on('click', function () {
        slideout_right.toggle();
        $('.slideout-menu-right').toggleClass('open');
    });

    $(".main-nav ").on("click",".menu-item-has-children >a.nav-link ",function(e){
    e.preventDefault();
    e.stopPropagation();
        var  $link = $(this);
        $link.parent().find(">.sub-items").toggleClass("show");
    
    })

       $(document).on('mouseup', function (e) { 
        var mobileNavcontainer = $(".nav-mobile");
        var toggleBtnCloseW = $(".toggle-button-left");
        var mobileMenuDiv = $('#nav-mobile');
        

        var toggleBtnCloseL = $(".toggle-button-right");
        var mobileMenuDivL = $('#navi-user');

        if (!mobileNavcontainer.is(e.target) && mobileNavcontainer.has(e.target).length === 0 && mobileMenuDiv.hasClass('open') && !toggleBtnCloseW.is(e.target) && toggleBtnCloseW.has(e.target).length === 0 ) {
            slideout_left.toggle();
            $('.slideout-menu-left').toggleClass('open');
        }

        if (!$(e.target).hasClass("nav-link") && !mobileNavcontainer.is(e.target) && mobileNavcontainer.has(e.target).length === 0 && mobileMenuDivL.hasClass('open') && !toggleBtnCloseL.is(e.target) && toggleBtnCloseL.has(e.target).length === 0 ) {
            slideout_right.toggle();
            $('.slideout-menu-right').toggleClass('open');
        }
    });
})(jQuery)