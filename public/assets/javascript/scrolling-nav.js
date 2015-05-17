//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});
if ( $('.scroll_top').length ) {
			$(window).scroll(function(){
				if ($(this).scrollTop() > 800) {
					$('.scroll_top').show().removeClass( 'et-hidden' ).addClass( 'et-visible' );
				} else {
					$('.scroll_top').removeClass( 'et-visible' ).addClass( 'et-hidden' );
				}
			});

			//Click event to scroll to top
			$('.scroll_top').click(function(){
				$('html, body').animate({scrollTop : 0},800);
			});
		}
