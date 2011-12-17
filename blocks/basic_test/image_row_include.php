<?php    defined('C5_EXECUTE') or die(_("Access Denied.")); 
$tool_helper = Loader::helper('concrete/urls');
$u = new User();
$uID = $u->getUserID();?> 
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
          <a href="<?php echo $tool_helper->getToolsURL('image_slider_attributes', 'caroufredsel_image_slider');?>?fID=<?php   echo $imgInfo['GalleryImgId']?>&uID=<?php echo $uID;?>" 
		   dialog-title="<?php echo t("Edit Attributes - %s",$imgInfo['fileName']);?>"
		   dialog-modal="false"
		   dialog-width="580" 
		   dialog-height="420" 
		   dialog-append-buttons="true"
		   class="btn"><?php echo t("Edit Attributes");?></a>
		<input type="hidden" name="imgFIDs[]" value="<?php   echo $imgInfo['fID']?>">
	</div>
</div>
