'use strict';
/********************************
 Preloader
 ********************************/
$(window).load(function() {
    $('.loading-container').fadeOut(1000, function() {
        $(this).remove();
    });
});

/* jshint ignore:start */


$(function(){


    /*$('.dropdown-menu').click(function(event){
     event.stopPropagation();
     });*/




    /********************************
     Toggle Aside Menu
     *******************************/

    $(document).on('click', '.navbar-toggle', function(){

        $('aside.left-panel').toggleClass('collapsed');

    });

    var url = window.location.href;
    $('a[href="'+url+'"]').parent('li').addClass('active');



    /********************************
     Aside Navigation Menu
     ********************************/

    $('aside.left-panel nav.navigation > ul > li:has(ul) > a').click(function(){

        if( $('aside.left-panel').hasClass('collapsed') === false || $(window).width() < 768 ){



            $('aside.left-panel nav.navigation > ul > li > ul').slideUp(300);
            $('aside.left-panel nav.navigation > ul > li').removeClass('active');

            if(!$(this).next().is(':visible'))
            {

                $(this).next().slideToggle(300,function(){ $('aside.left-panel:not(.collapsed)').getNiceScroll().resize(); });
                $(this).closest('li').addClass('active');
            }

            return false;

        }

    });

    /********************************
     Chosen Select
     ********************************/

    /********************************
     popover
     ********************************/
    if( $.isFunction($.fn.popover) ){
        $('.popover-btn').popover();
    }



    /********************************
     tooltip
     ********************************/
    if( $.isFunction($.fn.tooltip) ){
        $('.tooltip-btn').tooltip();
    }



    /********************************
     NanoScroll - fancy scroll bar
     ********************************/
    if( $.isFunction($.fn.niceScroll) ){
        $('.nicescroll').niceScroll({

            cursorcolor: '#9d9ea5',
            cursorborderradius : '0px'

        });
    }


    if( $.isFunction($.fn.niceScroll) ){
        $('aside.left-panel:not(.collapsed)').niceScroll({
            cursorcolor: '#8e909a',
            cursorborder: '0px solid #fff',
            cursoropacitymax: '0.5',
            cursorborderradius : '0px'
        });
    }



    /********************************
     TagsInput
     ********************************/
    if( $.isFunction($.fn.tagsinput) ){
        $('.tagsinput').tagsinput();
    }



    /********************************
     DateTime Picker
     ********************************/
    if( $.isFunction($.fn.datetimepicker) ){
        $('.datepicker').datetimepicker({pickTime: false});
    }


    /********************************
     wysihtml5
     ********************************/
    if( $.isFunction($.fn.wysihtml5) ){
        $('.wysihtml').wysihtml5();
    }



    /********************************
     wysihtml5
     ********************************/
    if( $.isFunction($.fn.ckeditor) ){
        CKEDITOR.disableAutoInline = true;
        $('#ckeditor').ckeditor();
        $('.inlineckeditor').ckeditor();
    }









    /********************************
     Scroll To Top
     ********************************/
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });




});

/* jshint ignore:end */