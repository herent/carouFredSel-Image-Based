<?php    defined('C5_EXECUTE') or die(_("Access Denied."));
		
	$maxH = 0;
	foreach($images as $imgInfo) {
		if($imgInfo['imgHeight'] > $maxH){
			$maxH = $imgInfo['imgHeight'];
		}
	};
	if($maxH > $maxHeight) 
	{
		$maxH = $maxHeight;
	}
	$thumbsize = 80;
	if($smallThumbs)
		$thumbsize=40;
?>	 

<div id="asmillerGalleryBlock" class="asmillerGalleryBlock">
<div id="asmillerGallery_main" class="asmillerMainImage"><!--Image goes in here-->
<div id="asmillerGallery_spacer"></div> <!--Spacer is used to make images stay vertically at the bottom-->

</div>
<div style="display: table; margin: 0 auto;">
<ul id="asmillerGallery" class="asmillerGallery" style="margin:0 auto;">


		<?php  	
	foreach($images as $imgInfo) {
	$f = File::getByID($imgInfo['fID']);
		echo $imgInfo['width'];
		echo '<li><img src="';
		echo $f->getRelativePath();
		echo '" ';
		echo 'title="';
		echo $imgInfo['description'];
		echo '"/></li>';
			;}; ?>
	</ul>
	</div>
		<script type="text/javascript"> 
	
	$(document).ready(function(){
	
		var maxHeight = <?php  echo $maxHeight ?>;
		var maxWidth = <?php  echo $maxWidth ?>;
	
		$('.asmillerGalleryBlock li').width(<?php   echo $thumbsize; ?>).height(<?php   echo $thumbsize ?>);

		$('ul.asmillerGallery li:first-child').addClass('asmillerGalleria_active'); 
	
		$("#asmillerGallery_main").height(<?php   echo $maxH ?>+50);		
		
		$('#asmillerGallery').asmillerGalleria({
			history   : false, // activates the history object for bookmarking, back-button etc.
			clickNext : true, // helper for making the image clickable
			insert    : '#asmillerGallery_main', // the containing selector for our main image
			onImage   : function(image,asmillerGalleria_caption,asmillerGalleria_thumb) { // let's add some image effects
				
				// fade in the image & caption
				image.css('display','none').fadeIn(750);
				asmillerGalleria_caption.css('display','none').fadeIn(2000);
				
				// fetch the thumbnail container
				var _li = asmillerGalleria_thumb.parents('li');
				
				// fade out inactive thumbnail
				_li.siblings().children('img.asmillerGalleria_active').fadeTo(500,0.3);
				
				$(".asmillerGalleria_wrapper").width(image.width());
				
				// fade in active thumbnail
				asmillerGalleria_thumb.fadeTo('fast',1).addClass('asmillerGalleria_active');
				
				// add a title for the clickable image
				image.attr('title','Next image >>');
				
				var height = image.height();
				var width = image.width();
				
				if(width > maxWidth) {
					height = height * maxWidth / width;
					width = maxWidth;
				}
				if(height > maxHeight){
					width = maxHeight * width / height;
					height = maxHeight;
				}
				
				image.width(width).height(height);
				
				$(".asmillerGalleria_wrapper").width(image.width());
				$("#asmillerGallery_spacer").height(<?php   echo $maxH ?>-image.height());
			},
			onasmillerGalleria_thumb : function(asmillerGalleria_thumb) { // thumbnail effects goes here
				
				// fetch the thumbnail container
				var _li = asmillerGalleria_thumb.parents('li');
				
				// if thumbnail is active, fade all the way.
				var _fadeTo = _li.is('.asmillerGalleria_active') ? '1' : '0.3';
				
				// fade in the thumbnail when finnished loading
				asmillerGalleria_thumb.css({display:'none',opacity:_fadeTo}).fadeIn(1500);
				
				// hover effects
				asmillerGalleria_thumb.hover(
					function() { asmillerGalleria_thumb.fadeTo('fast',1); },
					function() { _li.not('.asmillerGalleria_active').children('img').fadeTo('fast',0.3); } // don't fade out if the parent is active
				)
			}
		});		
	});
	</script> 
<div style="width:100%; clear:both;"></div>
</div>