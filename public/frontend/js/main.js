$(document).ready(function($){
	//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
	var MqL = 1170;
	//move nav element position according to window width
	moveNavigation();
	$(window).on('resize', function(){
		(!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
	});

	//mobile - open lateral menu clicking on the menu icon
	$('.cd-nav-trigger').on('click', function(event){
		event.preventDefault();
		if( $('.cd-main-content').hasClass('nav-is-visible') ) {
			closeNav();
			$('.cd-overlay').removeClass('is-visible');
		} else {
			$(this).addClass('nav-is-visible');
			$('.cd-main-header').addClass('nav-is-visible');
			$('.cd-main-content').addClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').addClass('overflow-hidden');
			});
			toggleSearch('close');
			$('.cd-overlay').addClass('is-visible');
		}
	});

	//open search form
	$('.cd-search-trigger').on('click', function(event){
		event.preventDefault();
		toggleSearch();
		closeNav();
	});
	
	$().UItoTop({ easingType: 'easeOutQuart' });

	//submenu items - go back link
	$('.go-back').on('click', function(){
		$(this).parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out');
	});

	function closeNav() {
		$('.cd-nav-trigger').removeClass('nav-is-visible');
		$('.cd-main-header').removeClass('nav-is-visible');
		$('.cd-primary-nav').removeClass('nav-is-visible');
		$('.has-children ul').addClass('is-hidden');
		$('.has-children a').removeClass('selected');
		$('.moves-out').removeClass('moves-out');
		$('.cd-main-content').removeClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$('body').removeClass('overflow-hidden');
		});
	}

	function toggleSearch(type) {
		if(type=="close") {
			//close serach 
			$('.cd-search').removeClass('is-visible');
			$('.cd-search-trigger').removeClass('search-is-visible');
			$('.cd-overlay').removeClass('search-is-visible');
		} else {
			//toggle search visibility
			$('.cd-search').toggleClass('is-visible');
			$('.cd-search-trigger').toggleClass('search-is-visible');
			$('.cd-overlay').toggleClass('search-is-visible');
			if($(window).width() > MqL && $('.cd-search').hasClass('is-visible')) $('.cd-search').find('input[type="search"]').focus();
			($('.cd-search').hasClass('is-visible')) ? $('.cd-overlay').addClass('is-visible') : $('.cd-overlay').removeClass('is-visible') ;
		}
	}

	function checkWindowWidth() {
		//check window width (scrollbar included)
		var e = window, 
            a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        if ( e[ a+'Width' ] >= MqL ) {
			return true;
		} else {
			return false;
		}
	}

	function moveNavigation(){
		var navigation = $('.cd-nav');
  		var desktop = checkWindowWidth();
        if ( desktop ) {
			navigation.detach();
			navigation.insertBefore('.cd-header-buttons');
		} else {
			navigation.detach();
			navigation.insertAfter('.cd-main-content');
		}
	}
	//Intialize WOW JS
    new WOW().init();

    $(".scroll").click(function(event){     
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });

    $('#example').countdown({
        date: '12/24/2020 15:59:59',
        offset: -8,
        day: 'Day',
        days: 'Days'
    }, function () {
       // alert('Done!');
    });
    
    $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        },
        controlNav: "thumbnails"
    });

    var defaults = {
        containerID: 'toTop',
        containerHoverID: 'toTopHover',
        scrollSpeed: 1200,
        easingType: 'linear' 
    };
    
    $().UItoTop({ easingType: 'easeOutQuart' });

    // Activate Carousel
    $("#myCarousel").carousel();
});

(function() {
    $('.widget_button').on('click', function() {
        $(this).parent().toggleClass('opened');
    });
    $('.close-nav').on('click', function() {
        $('.relative').toggleClass('opened');
    });
})();










// header dropdown icon
	$(document).ready(function(){
		$(".menu-button").click(function(){

			$(".mobile-menu-area").addClass("m-menu-zero");

			
		});
        $(".menu-close").click(function(){

			$(".mobile-menu-area").removeClass("m-menu-zero");

			
		});
	});
	
	
//mobile submenu
    $(document).ready(function(){
        $(".mobile-menu li").click(function(){
            $(this).children(".mobile-submenu").slideToggle(1000);
            $(".mobile-menu li a span").toggleClass("spanhide");
        });
        
        $(".mobile-submenu").parent(".mobile-menu li").children(".mobile-menu li a").append('<span></span>');
    });
	
	
	
// footer js
var rowing = document.querySelector(".cart-items .container .row");
    // rowing.onclick = function (){
    //     console.log("done");
    // }
	console.dir(rowing);
	
	
	
	
	
	
	