<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$img = Loader::helper('image');
?>

<div id="caroufredselImageSlider-<?php echo $bID;?>" class="caroufredsel-basic-image-carousel">
	<div id="slide-wrap-<?php echo $bID;?>" class="caroufredsel-basic-image-slide-wrap">
		<?php
		$i = 0;
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 210, 210, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		?>
	</div>
	<div class="caroufredsel-clearfix"></div>
</div>
<script type="text/javascript"> 
     $(document).ready(function() {
		$("#slide-wrap-<?php echo $bID;?>").carouFredSel({
			items: {
				visible: 3
			},
			scroll: {
				items: 1,
				duration: 1000,
				pauseDuration: 2000,
				onBefore        : function(oldItems, newItems, newSizes, duration) {
			            $("#slide-wrap-<?php echo $bID;?>").parent().parent().animate({ paddingLeft: (800 - newSizes.width) / 2, paddingRight: (800 - newSizes.width) / 2 }, duration);
			        }
			},
			auto: true
		}).parent().parent().css({
			paddingLeft: (800 - $("#slide-wrap-<?php echo $bID;?>").parent().outerWidth()) / 2 
		}).css({
			paddingRight: (800 - $("#slide-wrap-<?php echo $bID;?>").parent().outerWidth()) / 2 
		});
	});
</script>