<?php   defined('C5_EXECUTE') or die(_("Access Denied."));

	$maxHeight = 0;
	foreach($images as $imgInfo) {
		if($imgInfo['imgHeight'] > $maxHeight){
			$maxHeight = $imgInfo['imgHeight'];
		}
	};
	
	$thumbsize = 60;
	if($smallThumbs)
		$thumbsize=50;
?>	
	
	<script type="text/javascript"> 
	

	
	$(document).ready(function(){
	
		$('ul.asmillerGallery li').width(<?php  echo $thumbsize; ?>).height(<?php  echo $thumbsize; ?>);
		
		$('asmillerGalleryBlock').height(<?php  echo $maxHeight?> +50);

		$('ul.asmillerGallery li:first-child').addClass('asmillerGalleria_active'); 
		
		$('.asmillerGallery').asmillerGalleria({
			history   : false, // activates the history object for bookmarking, back-button etc.
			clickNext : true, // helper for making the image clickable
			insert    : '.asmillerMainImage', // the containing selector for our main image
			onImage   : function(image,asmillerGalleria_caption,asmillerGalleria_thumb) { // let's add some image effects for demonstration purposes
				
				// fade in the image & caption
				image.css('display','none').fadeIn(750);
				
								
				// add a title for the clickable image
				image.attr('title','Next image >>');
				$("#asmiller_gallery_caption_container").html($(".asmillerGalleria_caption").html());
				$("#asmillerGallery_spacer").height(<?php  echo $maxHeight ?>-image.height());
			}
		});
		
	});
	</script>  
<div class="asmillerGalleryBlock">	

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="215" align="center" valign="top">
		<ul class="asmillerGallery">
			<?php 	
			foreach($images as $imgInfo) {
				$f = File::getByID($imgInfo['fID']);
				echo '<li><img src="';
				echo $f->getRelativePath();
				echo '" ';
				echo 'title="';
				echo $imgInfo['description'];
				echo '"/></li>';
			;}; ?>
		</ul>
		<div id="asmiller_gallery_caption_container" style="padding-top: 25px; float:left; width:100%"></div>
	</td>
    <td rowspan="2" align="center" valign="middle"><div class="asmillerMainImage"></div></td>
  </tr>
  <tr>
    <td width="200" align="center" valign="bottom"></td>
  </tr>
</table>	


<div id="asmillerGallery_spacer" style="width:100%; clear:both; height:100px"></div>
</div>