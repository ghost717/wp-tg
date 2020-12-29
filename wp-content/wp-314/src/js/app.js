jQuery(document).ready(function ($) {

	// document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] +
	// ':35729/livereload.js?snipver=1"></' + 'script>')

	// SmoothScrolling
	// $('a[href*=#]:not([href=#])').click(function() {
	// 	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	// 	  var target = $(this.hash);
	// 	  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	// 	  if (target.length) {
	// 		$('html,body').animate({
	// 		  scrollTop: target.offset().top
	// 		}, 1000);
	// 		return false;
	// 	  }
	// 	}
	// });

	var mainSlider = $('.main__slider .owl-carousel');
	mainSlider.owlCarousel({
			loop:true,
			margin: 0,
			nav: true,
			dots: false,
			mouseDrag: false,
		//	lazyLoad : true,
		//	animateOut: 'fadeOut',
			navText: ["<", ">"],
			responsive:{
					0:{
							items:1
					},
					768:{
							items:1
					}
			}
	});

	var mainThumbslider = $('.main__thumbslider .owl-carousel');
	mainThumbslider.owlCarousel({
			loop:true,
			margin: 0,
			nav: false,
			dots: false,
			mouseDrag: false,
		//	lazyLoad : true,
		//	animateOut: 'fadeOut',
			navText: ["<", ">"],
			responsive:{
					0:{
							items:0
					},
					768:{
							items:2
					}
			}
	});

	$('.main__slider .owl-carousel .owl-next').click(function() {
		mainThumbslider.trigger('next.owl.carousel');
	});

	$('.main__slider .owl-carousel .owl-prev').click(function() {
		mainThumbslider.trigger('prev.owl.carousel');
	});

	var mainSonda = $('.main__sonda .owl-carousel');
	mainSonda.owlCarousel({
			loop:true,
			margin: 0,
			nav: true,
			dots: false,
			mouseDrag: false,
		//	lazyLoad : true,
		//	animateOut: 'fadeOut',
			navText: ["<", ">"],
			responsive:{
					0:{
							items:1
					},
					768:{
							items:1
					}
			}
	});

	var mainTeam = $('.main__team .owl-carousel');
	mainTeam.owlCarousel({
			loop:true,
			margin: 20,
			nav: true,
			dots: false,
			mouseDrag: false,
		//	lazyLoad : true,
		//	animateOut: 'fadeOut',
			navText: ["<", ">"],
			responsive:{
					0:{
							items:1
					},
					768:{
							items:3
					}
			}
	});

	var mainBanners = $('.bottom__banners .owl-carousel');
	mainBanners.owlCarousel({
			loop:true,
			margin: 0,
			nav: true,
			dots: false,
			mouseDrag: false,
		//	lazyLoad : true,
		//	animateOut: 'fadeOut',
			navText: ["<", ">"],
			responsive:{
					0:{
							items:1
					},
					768:{
							items:3
					}
			}
	});
	
	$(window).on('load', function(){
		$('.fc-row.fc-week').has('.fc-event').css('display', 'block');
	});
	
	$('input[name="l_glosow"]').click(function(e){
		e.preventDefault();

		var $formInput = $(this).val();
		var $postNR = $(this).next().val();
		var $postID = $(this).next().next().val();

		// console.log('var ' + $formInput);
		// console.log('nr' + $postNR);
		// console.log('id' + $postID);

		$.ajax({
			//url: anObject.ajaxurl,
			//url: 'http://'+window.location.host+'/wp-admin/admin-ajax.php',
			url: 'http://trefl.314-dev.pl/wp-admin/admin-ajax.php',
			data: {
				formInput: $formInput,
				postID: $postID,
				postNR: $postNR,
				action: 'your_function',
			},
			type: 'POST',
			dataType: 'text',
		})
		.done(function(data){
			console.log(data);
		})
		.fail(function(data){
			alert('ajax submit failed');
		});
	});

	// START MENU TOGGLE - PS
	var width = window.innerWidth ||
	document.documentElement.clientWidth ||
	document.body.clientWidth;

	if(width < 992){
		$(".menu__toggle").click(function(event) {
			toggleMenuTl.reversed(!toggleMenuTl.reversed());
		});
		var toggleMenuTl = new TimelineMax({paused:true,immediateRender:false});

		toggleMenuTl
		.set(".header", {className:"+=active"})
		.add('animateMenuLines')
		.to('.header__nav',0.5,{height:'100vh'},'animateMenuLines')
		.to('.menu__line:nth-child(1)',0.1,{top:'50%',transformOrigin:'center center',rotation:45},'animateMenuLines')
		.to('.menu__line:nth-child(2)',0.1,{width:0,autoAlpha:0},'animateMenuLines-=0.1')
		.to('.menu__line:nth-child(3)',0.1,{top:'50%',transformOrigin:'center center',rotation:-45},'animateMenuLines')
		.staggerFrom('#menu-menu-1 > *',0.6,{autoAlpha:0,yPercent:100},0.1,'animateMenuLines')
		.reverse()
		;

	} else {
		TweenLite.set('#menu-menu-1 > *',{clearProps:'all'});
	}
	window.addEventListener("resize", function() {
		if (window.matchMedia("(min-width: 992px)").matches) {
			console.log("Screen width is at least 992px");
			TweenLite.set('#menu-menu-1 > *',{clearProps:'all'});

		} else {
			console.log("Screen less than 992px");
		}
	});
	// END MENU TOGGLE - PS
	
	//getForm
	$(".more.--form").click(function(event) {
		event.preventDefault();
		$("#ajaxForm").toggleClass('active');
	});
	
	$("#ajaxForm #exit").click(function(event) {
		event.preventDefault();
		$("#ajaxForm").toggleClass('active');
	});
	

	$(document).on( 'scroll', function(){
        //console.log(headerHeight);

        //if ($(window).scrollTop() > 10 && $(window).width() < 768) {
        if ($(window).scrollTop() > 80) {
            $('.header__nav').addClass('fixed');

        } else {
            $('.header__nav').removeClass('fixed');
        }
	});
	
	AOS.init({
		duration: 0,
		delay: 0,
	});


	$('.main__sonda input').on( 'click', function(event){
		$('.main__sonda .sf .msg').html('Dziękujemy za oddanie głosu!');
	});

	$('.main__sonda a.more').on( 'click', function(event){
		event.preventDefault();

		var counter = $('.main__sonda .msg').attr('data-total');

		$('.main__sonda li').each(function () {
			var glosy = $(this).children('.glosy').text();
			console.log(glosy);
			var perc = counter/glosy;

			$(this).children('.glosy').text(perc);
		});

		$('.main__sonda input').css('visibility', 'hidden');
		$('.main__sonda .glosy').css('visibility', 'visible');
	});
});

function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 2000, 'linear');
}