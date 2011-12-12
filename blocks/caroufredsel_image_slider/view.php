<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$img = Loader::helper('image');
?>
<div class="slides-wrap" style="float:left;">
	<div class="slides-container bdr-orange shadow">
		<?php
		$i = 0;
		foreach ($images as $imgInfo) {
			$f = File::getByID($imgInfo['fID']);
			$newWidth = 0;
			$newHeight = 0;
			$thumb = $img->getThumbnail($f, 444, 277);
			if ($thumb->width < 444) {
				$newWidth = 644;
			}
			if ($thumb->height < 277) {
				$newHeight = 477;
			}
			if ($newWidth > 0 || $newHeight > 0) {
				if ($newWidth > 0 && $newHeight > 0) {
					$thumb = $img->getThumbnail($f, $newWidth, $newHeight);
				} else {
					if ($newHeight == 0) {
						$thumb = $img->getThumbnail($f, $newWidth, 10000);
					} else {
						$thumb = $img->getThumbnail($f, 10000, $newHeight);
					}
				}
			}
			echo "<div id='slide-{$i}' class='slide' style='background: #FAFAFE url({$thumb->src}) 50% 50% no-repeat;'>&nbsp;</div>";
			$i++;
		}
		?>
	</div>
</div>
	<div class="colThree" style="float:left;">
		<!-- TOUR NAV -->
		<div style="z-index:0!important;" class="callout tour  no-margin-top">
			<div id="tour-text-wrapper" class="inner no-margin-top no-padding-top">
				<?php if ($staticText) { ?>
				<div id="text-slide-0" class="text-slide">
					<h6 class="gray"><?php echo $staticTitle1; ?></h6>
					<div class="tour-wrapper">
						<div class="tour-button"><a class="control left" rel="last" href="#">&lt; LAST</a></div>
						<div class="tour-button last"><a class="control right" rel="next" href="#">NEXT &gt;</a></div>
						<div class="clearer"></div>
					</div>
					<h2 class="orange"><?php echo $staticTitle2; ?></h2>
					<p class="blue medium"><?php echo $staticParagraphText; ?></p>
				</div>
					<?php } else {
			foreach ($images as $imgInfo) { ?>
				<div id="text-slide-<?php echo $imgInfo['position'] ?>" class="text-slide">
					<h6 class="gray"><?php echo $imgInfo['title1']; ?></h6>
					<div class="tour-wrapper">
						<div class="tour-button"><a class="control left" rel="last" href="#">&lt; LAST</a></div>
						<div class="tour-button last"><a class="control right" rel="next" href="#">NEXT &gt;</a></div>
						<div class="clearer"></div>
					</div>
					<h2 class="orange"><?php echo $imgInfo['title2']; ?></h2>
					<p class="blue medium"><?php echo $imgInfo['paragraph']; ?></p>
				</div>
				<?php 
					}
				}?>
			</div>
		</div>
		<!-- END TOUR NAV -->
	</div>
<script type="text/javascript"> 
     var staticGalleryText = <?php echo $staticText; ?>
</script>