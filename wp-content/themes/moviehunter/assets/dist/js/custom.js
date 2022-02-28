(function( $j ) { 
	$("#owl-demo").owlCarousel({
 
	  autoPlay: 3000, //Set AutoPlay to 3 seconds
 
	  items : 5,
	  itemsDesktop : [640,4],
	  itemsDesktopSmall : [414,3]
 
	});

	$().UItoTop({ easingType: 'easeOutQuart' });

	$("#slidey").slidey({
		interval: 8000,
		listCount: 5,
		autoplay: false,
		showList: true
	}); 


	$(".dropdown").hover( function() {
		$('.dropdown-menu', this).stop( true, true ).slideDown("fast");
		$(this).toggleClass('open');        
		},
		function() {
			$('.dropdown-menu', this).stop( true, true ).slideUp("fast");
			$(this).toggleClass('open');       
	});

	$(".scroll").click(function(event){		
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
	});

	$('#table-breakpoint').DataTable();
 
}) (jQuery); 
