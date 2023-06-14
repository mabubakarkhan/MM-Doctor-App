/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Template
Version      : 1.3
*/

(function($) {
	"use strict";

	// Stick Sidebar
	
	if ($(window).width() > 767) {
		if($('.theiaStickySidebar').length > 0) {
			$('.theiaStickySidebar').theiaStickySidebar({
			  // Settings
				additionalMarginTop: 30
			});
		}
	}
	
	// Sidebar
	
	if($(window).width() <= 991){
		var Sidemenu = function() {
			this.$menuItem = $('.main-nav a.mobile-menu-btn');
		};

		function init() {
			var $this = Sidemenu;
			$('.main-nav a.mobile-menu-btn').on('click', function(e) {
				var main = $(this).parent('li');
				if($(this).parent().hasClass('has-submenu')) {
					e.preventDefault();
				}
				if(!$(this).hasClass('submenu')) {
					$.each($(main).find('ul'), function(index, val) {
						$(val).slideDown(150);
					});
					$(main).children('.mega-menu').slideDown(350);
					$(this).addClass('submenu');
				} else if($(this).hasClass('submenu')) {
					$(main).children('.mega-menu').slideUp(350);
					$.each($(main).find('ul'), function(index, val) {
						$(val).slideUp(150);
					});
					$(this).removeClass('submenu');
				}
			});
		}

	// Sidebar Initiate
		init();
	}
	
	// Textarea Text Count
	
	var maxLength = 100;
	$('#review_desc').on('keyup change', function () {
		var length = $(this).val().length;
		length = maxLength-length;
		$('#chars').text(length);
	});
	
	// Select 2
	
	if($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}
	
	// Date Time Picker
	
	if($('.datetimepicker').length > 0) {
		$('.datetimepicker').datetimepicker({
			format: 'DD/MM/YYYY',
			icons: {
				up: "fas fa-chevron-up",
				down: "fas fa-chevron-down",
				next: 'fas fa-chevron-right',
				previous: 'fas fa-chevron-left'
			}
		});
	}
	
	// Floating Label

	if($('.floating').length > 0 ){
		$('.floating').on('focus blur', function (e) {
			$(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
		}).trigger('blur');
	}
	
	// Mobile menu sidebar overlay
	
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$('main-wrapper').toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		return false;
	});
	
	$(document).on('click', '.sidebar-overlay', function() {
		$('html').removeClass('menu-opened');
		$(this).removeClass('opened');
		$('main-wrapper').removeClass('slide-nav');
	});
	
	$(document).on('click', '#menu_close', function() {
		$('html').removeClass('menu-opened');
		$('.sidebar-overlay').removeClass('opened');
		$('main-wrapper').removeClass('slide-nav');
	});
	
	// Tooltip
	
	if($('[data-bs-toggle="tooltip"]').length > 0 ){
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	}


	
	// Content div min height set
	
	function resizeInnerDiv() {
		var height = $(window).height();	
		var header_height = $(".header").height();
		var footer_height = $(".footer").height();
		var setheight = height - header_height;
		var trueheight = setheight - footer_height;
		$(".content").css("min-height", trueheight);
	}
	
	if($('.content').length > 0 ){
		resizeInnerDiv();
	}

	$(window).resize(function(){
		if($('.content').length > 0 ){
			resizeInnerDiv();
		}
	});
	
	// Slick Slider
	
	if($('.specialities-slider').length > 0) {
		$('.specialities-slider').slick({
			dots: true,
			autoplay:false,
			infinite: true,
			variableWidth: true,
			prevArrow: false,
			nextArrow: false
		});
	}
	
	if($('.testimonial-slider').length > 0) {
		$('.testimonial-slider').slick({
			dots: true,
			autoplay:false,
			infinite: true,
			prevArrow: false,
			nextArrow: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}

	if($('.doctor-slider').length > 0) {
		$('.doctor-slider').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			slidesToShow: 4,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}
	
	// Slider in tab
	
	if($('.section-specialities').length > 0) {
		$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function() {   
			$('.slider').slick('setPosition');
		});
	}
	

	// Slider
	
	if($('.doctor-slider1').length > 0) {
		$('.doctor-slider1').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			slidesToShow: 4,
			prevArrow: '<i class="fas fa-chevron-left"></i>',
			nextArrow: '<i class="fas fa-chevron-right"></i>',
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}
	if($('.features-slider').length > 0) {
		$('.features-slider').slick({
			dots: true,
			infinite: true,
			centerMode: true,
			slidesToShow: 4,
			speed: 500,
			variableWidth: true,
			arrows: false,
			autoplay:false,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}


	// Slick Slider
	if($('.features-slider1').length == 1) {
		$('.features-slider1').slick({
			dots: false,
			infinite: true,
			centerMode: false,
			slidesToShow: 1,
			speed: 500,
			variableWidth: true,
			arrows: true,
			autoplay:false,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 1
				}

			}]
		});
	}
	if($('.slider-1').length > 0) {
		$('.slider-1').slick();
	}

	//Home pharmacy slider
	if($('.dot-slider').length > 0) {
		$('.dot-slider').slick({
			dots: true,
			autoplay:false,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 1
				}
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 1
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 1
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}

	//clinic slider
	if($('.clinic-slider').length > 0) {
		$('.clinic-slider').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			rows: 2,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}

	//browse slider
	if($('.browse-slider').length > 0) {
		$('.browse-slider').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			rows: 2,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}

	//book doctor slider
	if($('.book-slider').length > 0) {
		$('.book-slider').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}

	//avalable features slider
	if($('.aval-slider').length > 0) {
		$('.aval-slider').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 1
				}
			}]
		});
	}
	//hospital-images-gallery slider
	if($('.hospital-images-gallery').length > 0) {
		$('.hospital-images-gallery').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			slidesToShow: 11,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 9
				}
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 8
				}
			},
			{
				breakpoint: 776,
				settings: {
					slidesToShow: 7
				}
			},
			{
				breakpoint: 567,
				settings: {
					slidesToShow: 5
				}
			}]
		});
	}
	//Home pharmacy slider
	if($('.pharmacy-home-slider .swiper-container').length > 0) {
		var swiper = new Swiper('.pharmacy-home-slider .swiper-container', {
			loop: true,
			speed: 1000,
			pagination: {
				el: '.pharmacy-home-slider .swiper-pagination',
				dynamicBullets: true,
				clickable: true,
			},
			navigation: {
				nextEl: '.pharmacy-home-slider .swiper-button-next',
				prevEl: '.pharmacy-home-slider .swiper-button-prev',
			},
		});
	}
	
	// Chat

	var chatAppTarget = $('.chat-window');
	(function() {
		if ($(window).width() > 991)
			chatAppTarget.removeClass('chat-slide');
		
		$(document).on("click",".chat-window .chat-users-list a.media",function () {
			if ($(window).width() <= 991) {
				chatAppTarget.addClass('chat-slide');
			}
			return false;
		});
		$(document).on("click","#back_user_list",function () {
			if ($(window).width() <= 991) {
				chatAppTarget.removeClass('chat-slide');
			}	
			return false;
		});
	})();

	//Increment Decrement Numberes
	var quantitiy=0;
	$('.quantity-right-plus').click(function(e){
		e.preventDefault();
		var quantity = parseInt($('#quantity').val());        
		$('#quantity').val(quantity + 1);
	});

	$('.quantity-left-minus').click(function(e){
		e.preventDefault();
		var quantity = parseInt($('#quantity').val());
		if(quantity>0){
			$('#quantity').val(quantity - 1);
		}
	});

     //Cart Click
	$("#cart").on("click", function(o) {
		o.preventDefault();
		$(".shopping-cart").fadeToggle();
		$(".shopping-cart").toggleClass('show-cart');
	});
	
	// Circle Progress Bar
	
	function animateElements() {
		$('.circle-bar1').each(function () {
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			var percent = $(this).find('.circle-graph1').attr('data-percent');
			var animate = $(this).data('animate');
			if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
				$(this).data('animate', true);
				$(this).find('.circle-graph1').circleProgress({
					value: percent / 100,
					size : 400,
					thickness: 30,
					fill: {
						color: '#da3f81'
					}
				});
			}
		});
		$('.circle-bar2').each(function () {
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			var percent = $(this).find('.circle-graph2').attr('data-percent');
			var animate = $(this).data('animate');
			if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
				$(this).data('animate', true);
				$(this).find('.circle-graph2').circleProgress({
					value: percent / 100,
					size : 400,
					thickness: 30,
					fill: {
						color: '#68dda9'
					}
				});
			}
		});
		$('.circle-bar3').each(function () {
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			var percent = $(this).find('.circle-graph3').attr('data-percent');
			var animate = $(this).data('animate');
			if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
				$(this).data('animate', true);
				$(this).find('.circle-graph3').circleProgress({
					value: percent / 100,
					size : 400,
					thickness: 30,
					fill: {
						color: '#1b5a90'
					}
				});
			}
		});
	}	
	
	if($('.circle-bar').length > 0) {
		animateElements();
	}
	$(window).scroll(animateElements);
	
	// Preloader
	
	$(window).on('load', function () {
		if($('#loader').length > 0) {
			$('#loader').delay(350).fadeOut('slow');
			$('body').delay(350).css({ 'overflow': 'visible' });
		}
	})
	
	//owl carousel
	
	if($('.owl-carousel.clinics').length > 0) {
		$('.owl-carousel.clinics').owlCarousel({
			loop:true,
			margin:15,
			dots: false,
			nav:true,
			navContainer: '.slide-nav-1',
			navText: [ '<i class="fas fa-chevron-left custom-arrow"></i>', '<i class="fas fa-chevron-right custom-arrow"></i>' ], 
			responsive:{
				0:{
					items:1
				},
				500:{
					items:1
				},
				768:{
					items:3
				},
				1000:{
					items:4
				},
				1300:{
					items:6
				}
			}
		})	
	}
	if($('.owl-carousel.our-doctors').length > 0) {
		$('.owl-carousel.our-doctors').owlCarousel({
			loop:true,
			margin:15,
			dots: false,
			nav:true,
			navContainer: '.slide-nav-2',
			navText: [ '<i class="fas fa-chevron-left custom-arrow"></i>', '<i class="fas fa-chevron-right custom-arrow"></i>' ], 
			responsive:{
				0:{
					items:1
				},
				500:{
					items:1
				},
				768:{
					items:2
				},
				1000:{
					items:3
				},
				1300:{
					items:4
				}
			}
		})	
	}
	if($('.owl-carousel.clinic-feature').length > 0) {
		$('.owl-carousel.clinic-feature').owlCarousel({
			loop:true,
			margin:15,
			dots: false,
			nav:true,
			navContainer: '.slide-nav-3',
			navText: [ '<i class="fas fa-chevron-left custom-arrow"></i>', '<i class="fas fa-chevron-right custom-arrow"></i>' ], 
			responsive:{
				0:{
					items:1
				},
				500:{
					items:1
				},
				768:{
					items:3
				},
				1000:{
					items:4
				},
				1300:{
					items:5
				}
			}
		})	
	}
	if($('.owl-carousel.blogs').length > 0) {
		$('.owl-carousel.blogs').owlCarousel({
			loop:true,
			margin:15,
			dots: false,
			nav:true,
			navContainer: '.slide-nav-4',
			navText: [ '<i class="fas fa-chevron-left custom-arrow"></i>', '<i class="fas fa-chevron-right custom-arrow"></i>' ], 
			responsive:{
				0:{
					items:1
				},
				500:{
					items:1
				},
				768:{
					items:2
				},
				1000:{
					items:3
				},
				1300:{
					items:4
				}
			}
		})	
	}
	
	//header-fixed
	
	if($('.header-trans').length > 0) {
		$(document).ready(function(){
			$(window).scroll(function(){
				var scroll = $(window).scrollTop();
				if (scroll > 95) {
					$(".header-trans").css("background" , "#FFFFFF");
				}

				else{
					$(".header-trans").css("background" , "transparent");  	
				}
			})
		})
	}
	if($('.header-trans.custom').length > 0) {
		$(document).ready(function(){
			$(window).scroll(function(){
				var scroll = $(window).scrollTop();
				if (scroll > 95) {
					$(".header-trans").css("background" , "#2b6ccb");
				}

				else{
					$(".header-trans").css("background" , "transparent");  	
				}
			})
		})
	}

	//BMI Status
	if($('#bmi-status').length > 0) {
		var options = {
			series: [{
				name: "BMI",
				data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
			}],
			chart: {
				height: 350,
				type: 'line',
				zoom: {
					enabled: false
				}
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				curve: 'straight'
			},
			title: {
				align: 'left'
			},
			grid: {
				row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
        	categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        }
      };

      var chart = new ApexCharts(document.querySelector("#bmi-status"), options);
      chart.render();
    }

	//Heart Rate Status
    if($('#heartrate-status').length > 0) {
    	var options = {
    		series: [{
    			name: 'HeartRate',
    			data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
    		}],
    		chart: {
    			height: 350,
    			type: 'line',
    		},
    		stroke: {
    			width: 7,
    			curve: 'smooth'
    		},
    		xaxis: {
    			type: 'datetime',
    			categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001','4/11/2001' ,'5/11/2001' ,'6/11/2001'],
    			tickAmount: 10,
    		},
    		title: {
    			align: 'left',
    		},
    		fill: {
    			type: 'gradient',
    			gradient: {
    				shade: 'dark',
    				gradientToColors: [ '#0de0fe'],
    				shadeIntensity: 1,
    				type: 'horizontal',
    				opacityFrom: 1,
    				opacityTo: 1,
    				stops: [0, 100, 100, 100]
    			},
    		},
    		markers: {
    			size: 4,
    			colors: ["#15558d"],
    			strokeColors: "#fff",
    			strokeWidth: 2,
    			hover: {
    				size: 7,
    			}
    		},
    		yaxis: {
    			min: -10,
    			max: 40,
    			title: {
    			},
    		}
    	};

    	var chart = new ApexCharts(document.querySelector("#heartrate-status"), options);
    	chart.render();
    }

	//FBC Status
    if($('#fbc-status').length > 0) {
    	var options = {
    		series: [{
    			name: 'FBC',
    			data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
    		}],
    		chart: {
    			height: 350,
    			type: 'bar',
    		},
    		plotOptions: {
    			bar: {
    				borderRadius: 10,
    				dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
        	enabled: true,
        	formatter: function (val) {
        		return val + "%";
        	},
        	offsetY: -20,
        	style: {
        		fontSize: '12px',
        		colors: ["#304758"]
        	}
        },
        
        xaxis: {
        	categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        	position: 'top',
        	axisBorder: {
        		show: false
        	},
        	axisTicks: {
        		show: false
        	},
        	crosshairs: {
        		fill: {
        			type: 'gradient',
        			gradient: {
        				colorFrom: '#0de0fe',
        				colorTo: '#0de0fe',
        				stops: [0, 100],
        				opacityFrom: 0.4,
        				opacityTo: 0.5,
        			}
        		}
        	},
        	tooltip: {
        		enabled: true,
        	}
        },
        yaxis: {
        	axisBorder: {
        		show: false
        	},
        	axisTicks: {
        		show: false,
        	},
        	labels: {
        		show: false,
        		formatter: function (val) {
        			return val + "%";
        		}
        	}

        },
        title: {
        	floating: true,
        	offsetY: 330,
        	align: 'center',
        	style: {
        		color: '#444'
        	}
        }
      };

      var chart = new ApexCharts(document.querySelector("#fbc-status"), options);
      chart.render();
    }

    //Weight Status
    if($('#weight-status').length > 0) {
    	var options = {
    		series: [{
    			name: 'Weight',
    			data: [34, 44, 54, 21, 12, 43, 33, 23, 66, 66, 58]
    		}],
    		chart: {
    			type: 'line',
    			height: 350
    		},
    		stroke: {
    			curve: 'stepline',
    		},
    		dataLabels: {
    			enabled: false
    		},
    		title: {
    			align: 'left'
    		},
    		markers: {
    			hover: {
    				sizeOffset: 4
    			}
    		}
    	};

    	var chart = new ApexCharts(document.querySelector("#weight-status"), options);
    	chart.render();
    }

	// Signup Toggle
    $(function () {
    	$("#is_registered").click(function () {
    		if ($(this).is(":checked")) {
    			$("#preg_div").show();
    		} else {
    			$("#preg_div").hide();
    		}
    	});
    });

	//Increment Decrement value
    $('.inc.button').click(function(){
    	var $this = $(this),
    	$input = $this.prev('input'),
    	$parent = $input.closest('div'),
    	newValue = parseInt($input.val())+1;
    	$parent.find('.inc').addClass('a'+newValue);
    	$input.val(newValue);
    	newValue += newValue;
    });
    $('.dec.button').click(function(){
    	var $this = $(this),
    	$input = $this.next('input'),
    	$parent = $input.closest('div'),
    	newValue = parseInt($input.val())-1;
    	console.log($parent);
    	$parent.find('.inc').addClass('a'+newValue);
    	$input.val(newValue);
    	newValue += newValue;
    });

	// Signup Profile
    function readURL(input) {
    	if (input.files && input.files[0]) {
    		var reader = new FileReader();

    		reader.onload = function (e) {
    			$('#prof-avatar').attr('src', e.target.result);
    		};

    		reader.readAsDataURL(input.files[0]);
    	}
    }
    $("#profile_image").change(function() {
    	readURL(this);
    });

	// Datepicker
    var maxDate = $('#maxDate').val();
    if($('#dob').length > 0) {
    	$('#dob').datepicker({
    		startView: 2,
    		format: 'dd/mm/yyyy',
    		autoclose: true,
    		todayHighlight: true,
    		endDate: maxDate
    	});
    }
    if($('#editdob').length > 0) {
    	$('#editdob').datepicker({
    		startView: 2,
    		format: 'dd/mm/yyyy',
    		autoclose: true,
    		todayHighlight: true,
    		endDate: maxDate
    	});
    }

	// Inspect keyCode

	/*$( window ).on( "load", function() {
		document.onkeydown = function(e) {
			if(e.keyCode == 123) {
			 return false;
			}
			if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
			 return false;
			}
			if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
			 return false;
			}
			if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
			 return false;
			}
		
			if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
			 return false;
			}      
		 };
		 
	});

	document.oncontextmenu = function() {return false;};
		$(document).mousedown(function(e){ 
		if( e.button == 2 ) { 
			return false; 
		} 
		return true; 
	});*/

  })(jQuery);

  $(document).ready(function($) {
  	$(".native-toast-edge").css('text-align', 'center');
  });

  function msgE(msg){
  	nativeToast({
  		message: msg,
  		edge: true,
  		position: 'bottom',
  		type: 'error'
  	})
  }
  function msgS(msg){
  	nativeToast({
  		message: msg,
  		edge: true,
  		position: 'bottom',
  		type: 'success'
  	})
  }

// ajax button loader fontawesome
  function ajaxBtnLoader(button) {
  	button.html('<i class="fas fa-spinner fa-spin"></i>');
  	return true;
  }

// ajax form error msg handling
  function ajaxErrorMsgShow(form, msg) {
  	form.before('<p class="alert alert-danger show-ajax-form-error">'+msg+'</p>');
  	return true;
  }
  function ajaxErrorMsgHide() {
  	$(".show-ajax-form-error").remove();
  	return true;
  }

// ajax form submit
function ajaxFormSubmit(form, successCallback, errorCallback) {
	ajaxErrorMsgHide(form);
	$.ajax({
		url: form.attr('action'),
		type: "POST",
		dataType: "json",
		data: form.serialize(),
		success: function(resp) {
			if (resp.status == false) {
				ajaxErrorMsgShow(form,resp.msg);
				successCallback(false);
			}
			else{
				successCallback(resp);
			}
		},
		error: function(xhr, status, error) {
			errorCallback(error);
		}
	});//ajax
}

//get cities ajax
$(document).on('change', 'select[name="state_id"]', function(event) {
	event.preventDefault();
	$this = $(this);
	$("."+$this.attr('data-city')).html("<option value=''>Select City</option>");
	if ($this.val().length > 0) {
		$.post('get-city-by-state-ajax', {id: $this.val()}, function(resp) {
			resp = $.parseJSON(resp);
			if (resp.status == true) {
				$("."+$this.attr('data-city')).html(resp.html);
			}
			nativeToast({
				message: resp.msg,
				edge: true,
				position: 'bottom',
				type: resp.type
			})
		});
	}
});