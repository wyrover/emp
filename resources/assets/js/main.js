'use strict';
/********************************
 Preloader
 ********************************/

var addLoading = function(){
    $('.loading-container').fadeIn(500);
}

var removeLoading = function(){
    $('.loading-container').fadeOut(500);
};


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
     提示框
     ********************************/
    StarPop.init({
        "selector": ".star-alert"
    });

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


    if(typeof Chart !== "undefined"){

        Chart.defaults.global = {
            // Boolean - Whether to animate the chart
            animation: true,
            // Number - Number of animation steps
            animationSteps: 60,

            // String - Animation easing effect
            // Possible effects are:
            // [easeInOutQuart, linear, easeOutBounce, easeInBack, easeInOutQuad,
            //  easeOutQuart, easeOutQuad, easeInOutBounce, easeOutSine, easeInOutCubic,
            //  easeInExpo, easeInOutBack, easeInCirc, easeInOutElastic, easeOutBack,
            //  easeInQuad, easeInOutExpo, easeInQuart, easeOutQuint, easeInOutCirc,
            //  easeInSine, easeOutExpo, easeOutCirc, easeOutCubic, easeInQuint,
            //  easeInElastic, easeInOutSine, easeInOutQuint, easeInBounce,
            //  easeOutElastic, easeInCubic]
            animationEasing: "linear",

            // Boolean - If we should show the scale at all
            showScale: true,

            // Boolean - If we want to override with a hard coded scale
            scaleOverride: false,

            // ** Required if scaleOverride is true **
            // Number - The number of steps in a hard coded scale
            scaleSteps: null,
            // Number - The value jump in the hard coded scale
            scaleStepWidth: null,
            // Number - The scale starting value
            scaleStartValue: null,

            // String - Colour of the scale line
            scaleLineColor: "rgba(0,0,0,.1)",

            // Number - Pixel width of the scale line
            scaleLineWidth: 1,

            // Boolean - Whether to show labels on the scale
            scaleShowLabels: true,

            // Interpolated JS string - can access value
            scaleLabel: "<%=value%>",

            // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
            scaleIntegersOnly: true,

            // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: false,

            // Number - Scale label font size in pixels
            scaleFontSize: 12,

            // String - Scale label font weight style
            scaleFontStyle: "normal",

            // String - Scale label font colour
            scaleFontColor: "#666",

            // Boolean - whether or not the chart should be responsive and resize when the browser does.
            responsive: true,

            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,

            // Boolean - Determines whether to draw tooltips on the canvas or not
            showTooltips: true,

            // Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-custom-tooltips))
            customTooltips: false,

            // Array - Array of string names to attach tooltip events
            tooltipEvents: ["mousemove", "touchstart", "touchmove"],

            // String - Tooltip background colour
            tooltipFillColor: "rgba(0,0,0,0.8)",


            // Number - Tooltip label font size in pixels
            tooltipFontSize: 14,

            // String - Tooltip font weight style
            tooltipFontStyle: "normal",

            // String - Tooltip label font colour
            tooltipFontColor: "#fff",


            // Number - Tooltip title font size in pixels
            tooltipTitleFontSize: 14,

            // String - Tooltip title font weight style
            tooltipTitleFontStyle: "bold",

            // String - Tooltip title font colour
            tooltipTitleFontColor: "#fff",

            // Number - pixel width of padding around tooltip text
            tooltipYPadding: 6,

            // Number - pixel width of padding around tooltip text
            tooltipXPadding: 6,

            // Number - Size of the caret on the tooltip
            tooltipCaretSize: 8,

            // Number - Pixel radius of the tooltip border
            tooltipCornerRadius: 6,

            // Number - Pixel offset from point x to tooltip edge
            tooltipXOffset: 10,

            // String - Template string for single tooltips
            tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",

            // String - Template string for multiple tooltips
            multiTooltipTemplate: "<%= value %>",

            // Function - Will fire on animation progression.
            onAnimationProgress: function(){},

            // Function - Will fire on animation completion.
            onAnimationComplete: function(){}
        };

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