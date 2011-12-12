<?php    defined('C5_EXECUTE') or die(_("Access Denied.")); ?> 
<div id="caroufredselImageSlider-imgRow<?php   echo $imgInfo['GalleryImgId']?>" class="caroufredselImageSlider-imgRow" >
	<div class="backgroundRow" style="background: url(<?php   echo $imgInfo['thumbPath']?>) no-repeat left top; padding-left: 100px">
		<div class="cm-GalleryBlock-imgRowIcons" >
			<div style="float:right">
				<a onclick="caroufredselImageSlider.moveUp('<?php   echo $imgInfo['GalleryImgId']?>')" class="moveUpLink"></a>
				<a onclick="caroufredselImageSlider.moveDown('<?php   echo $imgInfo['GalleryImgId']?>')" class="moveDownLink"></a>
			</div>
			<div style="margin-top:4px"><a onclick="caroufredselImageSlider.removeImage('<?php   echo $imgInfo['GalleryImgId']?>')"><img src="<?php   echo ASSETS_URL_IMAGES?>/icons/delete_small.png" /></a></div>
		</div>
		<strong><?php   echo $imgInfo['fileName']?></strong><br/><br/>
          <a onclick="caroufredselImageSlider.editAttributes('<?php   echo $imgInfo['GalleryImgId']?>')"><?php echo t("Edit Attributes");?></a>
		<input type="hidden" name="imgFIDs[]" value="<?php   echo $imgInfo['fID']?>">
	</div>
</div>
