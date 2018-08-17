//Use Strict Mode
(function ($) {
    "use strict";

    //Remove loading-wrapper class before window load
    setTimeout(function(){
      $('.loading-wrapper').removeClass('loading-wrapper-hide');
      return false;
    }, 10);

    //Adjust Viewport Function
    function adjustViewport() {
        var windowHeight = $(window).height();
        var TopbarHeight = $("#top-bar").outerHeight();
        var HeaderHeight = $("#masthead").outerHeight();
        var RealViewport = windowHeight - TopbarHeight - HeaderHeight;
        $('.viewport').css('min-height', RealViewport);            
        return false;
    }

    //Begin - Window Load
    $(window).load(function () {

       adjustViewport();

        //Page Loader 
        setTimeout(function(){
            $('#loader-name').addClass('loader-up');
            $('#loader-job').addClass('loader-up');
            $('#loader-animation').addClass('loader-up');
            return false;
        }, 500); 
        setTimeout(function(){
            $('#page-loader').addClass('loader-out');
            $('#intro-item1').addClass('active');
            return false;    
        }, 1100);  
        $('#page-loader').delay(1600).fadeOut(10);  
        setTimeout(function(){
            $('#page-loader').hide();
            return false;    
        }, 1700);


        //Main Slider
        var mainSlider = $(".main-carousel");

        mainSlider.on('initialized.owl.carousel', function(e){
            $('.slide-title').addClass('active');
            $('.slide-icon').addClass('active');
            $('.slide-text').addClass('active');
            $('.featured-slide .primary-btn').addClass('active');
        }); 
        
        mainSlider.owlCarousel({
            items: 1,
            nav: true,
            loop: false
        });

        mainSlider.on('changed.owl.carousel', function(e){          
            $('.slide-title').removeClass('active');
            $('.slide-icon').removeClass('active');
            $('.slide-text').removeClass('active');
            $('.featured-slide .primary-btn').removeClass('active');    
            return false;
        });
         

        mainSlider.on('translated.owl.carousel', function(e){
            $('.slide-title').addClass('active');
            $('.slide-icon').addClass('active');
            $('.slide-text').addClass('active');
            $('.featured-slide .primary-btn').addClass('active');
            return false;
        });


        //======Counters

        //Counter 1 Number (edit Here)        
        var $count1 = 135;
        //Counter 2 Number (edit Here)  
        var $count2 = 142;
        //Counter 3 Number (edit Here)  
        var $count3 = 178;

        // Counters (Used with Waypoints.JS)
        $('body').imagesLoaded( function() {
            $('.container-counters').waypoint(function () {

                // >> Finished projects
                $('.counter-item-title1').countTo({
                    from: 0,
                    to: $count1,
                    speed: 1400,
                    refreshInterval: 50
                });

                // >> Happy Customers
                $('.counter-item-title2').countTo({
                    from: 0,
                    to: $count2,
                    speed: 1400,
                    refreshInterval: 50
                });

                // >> Working Hours
                $('.counter-item-title3').countTo({
                    from: 0,
                    to: $count3,
                    speed: 1400,
                    refreshInterval: 50
                });
            }, {
                triggerOnce: true,
                offset: '95%'
            });
        }); 

        //Clients        
        $(".clients-carousel").owlCarousel({
            items: 5,
            nav: false,
            margin: 20
        });

        //Testimonials
        $(".testimonial-carousel").owlCarousel({
            items: 1,
            nav: true,          
        });

        //Team
        $(".team-carousel").owlCarousel({
            items: 4,
            nav: false,
            margin: 10
        });

    });

    //Runs on window Resize
    $(window).resize(function() {
        adjustViewport();
    });

    //Begin - Document Ready
    $(document).ready(function () {

        //WAYPOINTS
        $('.content-area').waypoint(function (direction) {
            if (direction === 'down') {
                $('#masthead').addClass('header-stick');
                $('#top-bar').addClass("topbar-hide");
                $('#back-to-top').removeClass('back-to-top-hide');
            } else {
                $('#masthead').removeClass('header-stick');
                $('#top-bar').removeClass("topbar-hide");
                $('#back-to-top').addClass('back-to-top-hide');
            }
        }, {
            offset: '-20px'
        });        

        //Back to Top Btn
        $('.back-to-top').on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 700);
            return false;
        });        

        //Anchor Smooth Scroll
        $('a[href*=#]:not([href=#])').on('click', function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });

        // Mobile Menu Js
        $("#MobileMenu").off("click").on("click", function () {
            $(this).toggleClass("menu-clicked");
            $("#main-navigation").stop(0, 0).slideToggle();
            $("#main-navigation a").on("click", function () {
                $("#MobileMenu").stop(0, 0).trigger("click");
            });
            $(".top-bar-append").empty().append($("#top-bar .row").html());
        });

        //Form Validator and Ajax Sender
        $(".main-contact-form").validate({
          submitHandler: function(form) {
            $.ajax({
              type: "POST",
              url: "https://trueley.com/inicio/contact",
              data: {
                "nombre": $(".main-contact-form #name").val(),
                "email": $(".main-contact-form #email").val(),
                "asunto": $(".main-contact-form #subject").val(),
                "mensaje": $(".main-contact-form #message").val(),
                "captcha": $(".main-contact-form #g-recaptcha-response").val()
              },
              dataType: "json",
              success: function (data) {
                  console.log(data);
                if (data == "200") {
                  $('#contactWait').hide();
                  $("#contactSuccess").fadeIn(300).addClass('modal-show');
                  $("#contactError").addClass("hidden");  
                  $(".main-contact-form #name, .main-contact-form #email, .main-contact-form #subject, .main-contact-form #message")
                    .val("")
                    .blur();         
                } else {
                  $('#contactWait').hide();
                  $("#contactError").fadeIn(300).addClass('modal-show');
                  $("#contactSuccess").addClass("hidden");
                }
              },
              beforeSend: function() {
                $('#contactWait').fadeIn(200);
              }
            });
          }
        });

        //Modal for Contact Form
        $('.modal-wrap').on('click', function () {
          $('.modal-wrap').fadeOut(300);
        }); 

        //Modal for Forms
        function hideModal() {
          $('.modal-wrap').fadeOut(300);
          return false;
        }

        $('.modal-wrap').on('click', function () {
          hideModal();
        });   

        $('.modal-bg').on('click', function () {
          hideModal();
        }); 
        
        //End - Document Ready
    });

    //End - Use Strict mode
})(jQuery);