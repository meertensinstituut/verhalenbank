var fixedNav = false,
    carouselfototimer;
var el = document.getElementsByTagName('html')[0];
    if( window.matchMedia && window.matchMedia('(min--moz-device-pixel-ratio: 1.3),(-o-min-device-pixel-ratio: 2.6/2),(-webkit-min-device-pixel-ratio: 1.3),(min-device-pixel-ratio: 1.3), (min-resolution: 1.3dppx)').matches ) {
        el.classList.add('retina');
    }

$(function(){

    wHeight = $(window).height();
    $("#holdmap").css("height",wHeight+"px");
    $(document).on("click","#meta-nav",function(){
        $("html, body").animate({

            scrollTop: $(document).height()+"px"
        },'slow',function(){
        });

    });

    $(".carousel")
        .on('click','.description',function(){
            var $thisdescr = $(this);
            if ($thisdescr.hasClass("isVis")){
    //            clearTimeout(carouselfototimer)
    //            $thisdescr.removeClass('isVis');
            } else {
                $thisdescr.addClass('isVis');
                carouselfototimer = setTimeout(function(){
                    $thisdescr.fadeOut('slow',function(){
                        $thisdescr.removeClass("isVis").css("display","");
                    })
                },4000)
            }
        })
        .on('click','.carousel-large li figure',function(e){

            var $carousel = $(this).parents("ul"),
                $curli = $carousel.find('.current'),
                $curthumb = $(this).parents('.carousel').find('.carousel-thumb').find('.current'),
                $nextli = $curli.next(),
                $nextthumb = $curthumb.next();
            if ($nextli.length){
                $nextli.addClass("current");
            } else {
                $carousel.find("li:first").addClass("current")
            }

            if ($nextthumb.length){
                $nextthumb.addClass("current");
            } else {
                $curthumb.parents('.carousel-thumb').find("li:first").addClass("current");
            }
            $curthumb.removeClass("current");
            setTimeout(function(){
                $curli.removeClass("current").appendTo($carousel);
            },400)
        })
    $(document).on("click","#main-nav",function(){
        $mainnav = $(this);
        if ($(this).hasClass("showmain")){
            $mainnav.find(">ul").slideUp('slow',function(){
                $mainnav.removeClass("showmain");
                $mainnav.find(">ul").css("display","");
            });
            $("#site-search").slideUp('slaw',function(){

            });
        } else {
            $mainnav.find(">ul").slideDown('slow',function(){
                $mainnav.addClass("showmain");
                $mainnav.find(">ul").css("display","");
            });
            $("#site-search").slideDown('slaw',function(){

            });
        }
    });
    $(".nav-select").each(function(){
        $thisnav = $(this);
                $newselect=  $("<select />")
                $firstchoice = $thisnav.find("h2").text();

                  // Create default option "Go to..."
                  $("<option />", {
                     "selected": "selected",
                     "value"   : "",
                     "text"    : $firstchoice+'...'
                  }).appendTo($newselect);

                  // Populate dropdown with menu items
                    $thisnav.find("li > a").each(function() {
                   var el = $(this);
                   $("<option />", {
                       "value"   : el.attr("href"),
                       "text"    : el.text()
                   }).appendTo($newselect);
                  });
                    $newselect.appendTo($thisnav);

            	   // To make dropdown actually work
            	   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
                  $("nav select").change(function() {
                    window.location = $(this).find("option:selected").val();
                  });

    })
    if (Modernizr.touch){
    //if (1==1){
        $("#main-nav > ul").on("click","li", function(){
            if ($(this).hasClass("showul")){
                $(this).removeClass("showul");
                $(this).addClass("hideul");
               $(this).blur();
            } else {
                $(this).addClass("showul");
                $(this).removeClass("hideul");
            }
            return false;
        })




    } else {
        $("#main-nav > ul").on("mouseenter mouseleave","li", function(e){

            if (e.type == "mouseleave"){
               $(this).removeClass("showul");
           } else {
               $(this).addClass("showul");
           }
       })
    }


    fixnavdistance = 35; //parseFloat($("#main-nav").css("marginTop"));

    if (fixedNav){

        if ($(document).scrollTop() > fixnavdistance){

            fixNav();
        }
    }
        $(window).scroll(function(){
            if ($(window).scrollTop() > fixnavdistance){
                if (!fixedNav){
                    fixNav();
                }
            } else {
                $("body").addClass('expanded');
                $("#meta-nav").removeClass("navshowed")
            }
        });



//    $('#container').waypoint(function(direction) {
//      if (direction == "down"){
//          fixNav()
//      } else {
//          $("#main").css("padding-top","");
//          $("body").removeClass("scrolled");
//      }
//
//      });
    if (!Modernizr.mq('only screen and (min-width: 768px)')){
       // so we're not using googlemaps, we'll set an image as the background
        $("#map_canvas").css("background-image", "url(css/images/map_meertens.gif)");
    }

    $(".shownav").click(function(){
        if ($(this).hasClass("metanav")){
           $navtoshow =  $("#meta-nav");
        } else {
            $navtoshow =  $("#main-nav");
        }

        if ($navtoshow.hasClass("navshowed")){
            $(this).removeClass("hidenav")
            $navtoshow.removeClass("navshowed")
        } else {
            $(this).addClass("hidenav")
            $navtoshow.addClass("navshowed")
        }
        return false;
    })
}); // end document ready

function fixNav(){
   $("body").removeClass('expanded');
}


(function($) {
    function toggleLabel() {
        var input = $(this);
        setTimeout(function() {
            var def = input.attr('title');
            if (!input.val() || (input.val() == def)) {
                input.prev('label').css('visibility', '');
                if (def) {
//                    var dummy = $('<label></label>').text(def).css('visibility','hidden').appendTo('body');
//                    input.prev('span').css('margin-left', dummy.width() + 3 + 'px');
//                    dummy.remove();
                }
            } else {
                input.prev('label').css('visibility', 'hidden');
            }
        }, 0);
    };

    function resetField() {
        var def = $(this).attr('title');
        if (!$(this).val() || ($(this).val() == def)) {
            $(this).val(def);
            $(this).prev('label').css('visibility', '');
        }
    };

    $(document).on('keydown','input, textarea', toggleLabel);
    $(document).on('paste','input, textarea', toggleLabel);
    $(document).on('change','select', toggleLabel);
    $(document).on('focusin','input, textarea', function() {
        $(this).prev('label').css('color', '#ccc');
    });
    $(document).on('focusout','input, textarea', function() {
        $(this).prev('label').css('color', '#999');
    });

    $(function() {
        $('.smallform .formline input, .smallform .formline textarea').each(function() { toggleLabel.call(this); });
    });

})(jQuery);