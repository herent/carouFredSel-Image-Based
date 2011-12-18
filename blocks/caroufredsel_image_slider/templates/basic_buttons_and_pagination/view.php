<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$img = Loader::helper('image');
?>

<div id="caroufredselImageSlider-<?php echo $bID;?>" class="caroufredsel-basic-buttons-and-pagination-carousel">
	<div id="slide-wrap-<?php echo $bID;?>" class="caroufredsel-basic-buttons-and-pagination-slide-wrap">
		<?php
		$i = 0;
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 280, 280, true);
			
			echo "<div id='slide-{$i}' class='slide' style='background: url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		?>
	</div>
	<div class="caroufredsel-clearfix"></div>
	<a class="caroufredsel-prev" id="prev-<?php echo $bID;?>" href="#"><span>prev</span></a>
	<a class="caroufredsel-next" id="next-<?php echo $bID;?>" href="#"><span>next</span></a>
	<div class="caroufredsel-pagination" id="pagination-<?php echo $bID;?>"></div>
</div>
<script type="text/javascript"> 
     $(document).ready(function() {
		$("#slide-wrap-<?php echo $bID;?>").carouFredSel({
			width: 754,
			circular: false,
			infinite: false,
			auto: false,
			scroll: {
				items: 2,
				duration: 1000,
				pauseDuration: 2000,
				onBefore        : function(oldItems, newItems, newSizes, duration) {
			            $("#slide-wrap-<?php echo $bID;?>").parent().parent().animate({ paddingLeft: (800 - newSizes.width) / 2, paddingRight: (800 - newSizes.width) / 2 }, duration);
			        }
			},
			prev: {
				button : "#prev-<?php echo $bID;?>",
				key:	"left",
				items: 2,
				easing: "easeInOutCubic",
				duration: 750
			},
			next: {
				button: "#next-<?php echo $bID;?>",
				key: "right",
				items: 2,
				easing: "easeInOutCubic",
				duration: 750
			},
			pagination: {
				container: "#pagination-<?php echo $bID;?>",
				keys: false,
				items: 2,
				easing: "easeInOutCubic",
				duration: 750
			}
		}).parent().parent().css({
			paddingLeft: (800 - $("#slide-wrap-<?php echo $bID;?>").parent().outerWidth()) / 2 
		}).css({
			paddingRight: (800 - $("#slide-wrap-<?php echo $bID;?>").parent().outerWidth()) / 2 
		});
	});
</script>