<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$img = Loader::helper('image');
?>

<div id="caroufredselImageSlider-<?php echo $bID;?>" class="caroufredsel-single-slide-full-html-carousel">
	<div id="slide-wrap-<?php echo $bID;?>" class="caroufredsel-single-slide-full-html-slide-wrap">
		<?php
		$i = 0;
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 800, 800, true);
			$slideTitle = $f->getApprovedVersion()->getAttribute('caroufredsel_image_slider_title');
			$slideText = $f->getApprovedVersion()->getAttribute('caroufredsel_image_slider_text');
			$slideLink = $f->getApprovedVersion()->getAttribute('caroufredsel_image_slider_link');
			$includeLink = $slideLink->getIncludeLink();
			if ($includeLink){
				$linkUrl = $slideLink->getUrl();
				$linkText = $slideLink->getLinkText();
			}
			echo "<div id='caroufredsel-single-slide-full-html-{$i}' class='caroufredsel-slide' style='background: url({$thumb->src}) 50% 50% no-repeat;height:{$thumb->height}px;'>";
			
			echo "<h2 class='caroufredsel-title'>" . $slideTitle . '</h2>';
			echo "<div class='caroufredsel-text'>" . $slideText . '</div>';
			if ($includeLink){
				echo "<a class='caroufredsel-link' href='". $linkUrl ."'>" . $linkText . "</a>";
			}
			echo "</div>";
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
			width: 800,
			circular: true,
			infinite: true,
			auto: true,
			scroll: {
				items: 1,
				duration: 750,
				pauseDuration: 5000
			},
			prev: {
				button : "#prev-<?php echo $bID;?>",
				key:	"left",
				items: 1,
				easing: "easeInOutCubic",
				duration: 750
			},
			next: {
				button: "#next-<?php echo $bID;?>",
				key: "right",
				items: 1,
				easing: "easeInOutCubic",
				duration: 750
			},
			pagination: {
				container: "#pagination-<?php echo $bID;?>",
				keys: false,
				items: 1,
				easing: "easeInOutCubic",
				duration: 750
			}
		});
	});
</script>