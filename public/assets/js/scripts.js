/*
Author       : Theme_Ocean.
Template Name: Hilux - Real Estate HTML Template 
Version      : 1.0
*/
(function($) {
	'use strict';
	
	jQuery(document).on('ready', function(){
	
		/*PRELOADER JS*/
		$(window).on('load', function() { 
			$('.status').fadeOut();
			$('.preloader').delay(350).fadeOut('slow'); 
		}); 
		/*END PRELOADER JS*/
		


		/*START MIXITUP JS*/	
		jQuery('#gallery .row').mixitup({
			targetSelector: '.mix',
		});		
		$("a[class^='prettyPhoto']").prettyPhoto();
		/*END MIXITUP JS*/		

		/*START PORTFOLIO POPUP JS*/
		 $("a[data-rel^='prettyPhoto']").prettyPhoto();				 
		 $('#projectModal').on('shown.bs.modal', function () {
		  $('#myInput').focus()
		 })
		/*END PORTFOLIO POPUP JS*/

		/*START VIDEO JS*/
		$('.video-play').magnificPopup({
            type: 'iframe'
        });
		/*END VIDEO JS*/		
		  
		/*START PARTNER LOGO*/
		$('.partner').owlCarousel({
		  autoPlay: 9000, //Set AutoPlay to 3 seconds
		  items : 4,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3]
		});
		/*END PARTNER LOGO*/
		
		/*START TESTIMONIAL JS*/	
		$('.testimonial1-carousel').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			nextArrow: '<i class="fa fa-chevron-right next"></i>',
			prevArrow: '<i class="fa fa-chevron-left prev"></i>',
			dots: true,
			fade: false,
			autoplay: true,
			autoplaySpeed: 2000,
		});
		/*END TESTIMONIAL JS*/			
	}); 		
	
	/* START PARALLAX JS */
	(function () {
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) { 
		} else {
			$(window).stellar({
				horizontalScrolling: false,
				responsive: true
			});
		}
	}());
	/* END PARALLAX JS  */		
	
	/*START WOW ANIMATION JS*/
	  new WOW().init();	
	/*END WOW ANIMATION JS*/	
				
})(jQuery);


  

