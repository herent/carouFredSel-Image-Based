$(document).ready(function(){
	slides =  $('.slide');
	homeSlider = {
		currentPosition : 0,
		slideWidth : 444,
		slides : $('.slide'),
		numberOfSlides : slides.length,
		init : function(){
			$('.slides-container').css('overflow', 'hidden');
			$('.slides-container').css('width', '444px');
			$('.slides-container').css('height', '277px');
               $('.text-slide').hide();
               $('#text-slide-0').show();
			this.slides.wrapAll('<div id="slideInner"></div>').css({
				'float' : 'left',
				'width' : this.slideWidth
			});
			$('#slideInner').css('width', this.slideWidth * this.numberOfSlides);
			this.prepNextSlide(this.currentPosition);
			$('.control')
			.bind('click', function(){
				homeSlider.disableSlideshow();
				// Determine new position
				// homeSlider.currentPosition = ($(this).attr('id')=='rightControl') ? homeSlider.currentPosition+1 : homeSlider.currentPosition-1;
				// Hide / show controls
				homeSlider.prepNextSlide($(this).attr('rel'));
				// Move slideInner using margin-left
				homeSlider.nextSlide();
                    return false;
			});
//			this.playSlideShow();
		},
		prepNextSlide : function(direction){
			// Hide left arrow if position is first slide
			position = homeSlider.currentPosition;

               if (direction == 'last'){
                    if(position==0){
                         homeSlider.currentPosition = homeSlider.numberOfSlides - 1;
                    } else{
                         --homeSlider.currentPosition
                    }
               }
			if (direction == 'next'){
                    if(position==homeSlider.numberOfSlides-1){
                         homeSlider.currentPosition = 0;
                    } else{
                         ++homeSlider.currentPosition;

                    }
               }
		},
		nextSlide : function () {
			$('#slideInner').animate({
					'marginLeft' : -homeSlider.slideWidth*(homeSlider.currentPosition)
				}, {
					duration: 2500,
					easing: "easeOutExpo"
				});
               if (!staticGalleryText){
                    $('.text-slide').hide();
                    $('#text-slide-' + homeSlider.currentPosition).show();
               }
		},
		disableSlideshow: function() {
			clearInterval(this.slideshow);
		},
		playSlideShow: function(){
			this.slideshow = setInterval( "homeSlider.slideSwitch()", 7500 );
		},
		slideSwitch: function(){
			nextSlide = this.currentPosition+1;
			if (nextSlide == this.numberOfSlides){
				nextSlide = 0;
			}
			this.currentPosition = nextSlide;
			this.nextSlide();
		}

	}
	homeSlider.init();
});