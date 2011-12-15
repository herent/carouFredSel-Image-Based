<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$form = Loader::helper('form');
$al = Loader::helper('concrete/asset_library');
$ah = Loader::helper('concrete/interface');
?>
<style type="text/css">
	.caroufredselImageSlider-imgRow .btn {
		text-decoration: none;
		cursor: pointer;
		display: inline-block;
		background-color: #e6e6e6;
		background-repeat: no-repeat;
		background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), color-stop(25%, #ffffff), to(#e6e6e6));
		background-image: -webkit-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
		background-image: -moz-linear-gradient(top, #ffffff, #ffffff 25%, #e6e6e6);
		background-image: -ms-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
		background-image: -o-linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
		background-image: linear-gradient(#ffffff, #ffffff 25%, #e6e6e6);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e6e6e6', GradientType=0);
		padding: 5px 14px 6px;
		text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
		color: #333;
		font-size: 13px;
		line-height: normal;
		border: 1px solid #ccc;
		border-bottom-color: #bbb;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
		-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
		-webkit-transition: 0.1s linear all;
		-moz-transition: 0.1s linear all;
		-ms-transition: 0.1s linear all;
		-o-transition: 0.1s linear all;
		transition: 0.1s linear all;
	}
     .ccm-input-wrap {
          display: block;
          padding-bottom: 5px;
          margin-bottom: 5px;

     }
	.ccm-input-wrap label {
		font-weight: bold;
		display: block;
		width: 100%;
		text-align: left;
	}
     #caroufredselImageSlider-imgRows a{
          cursor:pointer
     }
     #caroufredselImageSlider-imgRows .caroufredselImageSlider-imgRow,
     #caroufredselImageSlider-fsRow {
          margin-bottom:16px;
          clear:both;
          padding:7px;
          background-color:#eee
     }
     #caroufredselImageSlider-imgRows .caroufredselImageSlider-imgRow a.moveUpLink{
          display:block;
          background:url(<?php echo DIR_REL . '/' . DIRNAME_APP ?>/images/icons/arrow_up.png) no-repeat center;
          height:10px;
          width:16px;
     }
     #caroufredselImageSlider-imgRows .caroufredselImageSlider-imgRow a.moveDownLink{
          display:block;
          background:url(<?php echo DIR_REL . '/' . DIRNAME_APP ?>/images/icons/arrow_down.png) no-repeat center;
          height:10px;
          width:16px;
     }
     #caroufredselImageSlider-imgRows .caroufredselImageSlider-imgRow a.moveUpLink:hover{
          background:url(<?php echo DIR_REL . '/' . DIRNAME_APP ?>/images/icons/arrow_up_black.png) no-repeat center;
     }
     #caroufredselImageSlider-imgRows .caroufredselImageSlider-imgRow a.moveDownLink:hover{
          background:url(<?php echo DIR_REL . '/' . DIRNAME_APP ?>/images/icons/arrow_down_black.png) no-repeat center;
     }
     #caroufredselImageSlider-imgRows .cm-GalleryBlock-imgRowIcons{ 
          float:right;
          width:35px;
          text-align:left;
     }

</style>
<div class="ccm-ui">
	<div class="ccm-input-wrap">
		<label for="type"><?php echo t('Type') ?></label>
		<select id="type" name="type" style="vertical-align: middle">
			<option value="CUSTOM"<?php if ($type == 'CUSTOM') { ?> selected<?php } ?>><?php echo t('Custom Gallery') ?></option>
			<option value="FILESET"<?php if ($type == 'FILESET') { ?> selected<?php } ?>><?php echo t('Pictures from File Set') ?></option>
		</select>
	</div>
	<span id="caroufredselImageSlider-chooseImg"><?php echo $ah->button_js(t('Add Image'), 'caroufredselImageSlider.chooseImg()', 'left'); ?></span>

	<div id="caroufredselImageSlider-imgRows">
		<?php
		if ($fsID <= 0) {
			foreach ($images as $imgInfo) {
				$f = File::getByID($imgInfo['fID']);
				$fp = new Permissions($f);
				$imgInfo['thumbPath'] = $f->getThumbnailSRC(1);
				$imgInfo['fileName'] = $f->getTitle();
				if ($fp->canRead()) {
					$this->inc('image_row_include.php', array('imgInfo' => $imgInfo));
				}
			}
		}
		?>
	</div>

	<?php
	Loader::model('file_set');
	$s1 = FileSet::getMySets();
	$sets = array();
	foreach ($s1 as $s) {
		$sets[$s->fsID] = $s->fsName;
	}
	$fsInfo['fileSets'] = $sets;

	if ($fsID > 0) {
		$fsInfo['fsID'] = $fsID;
	} else {
		$fsInfo['fsID'] = '0';
	}
	$this->inc('fileset_row_include.php', array('fsInfo' => $fsInfo));
	?> 

	<div id="imgRowTemplateWrap" style="display:none">
		<?php
		$imgInfo['GalleryImgId'] = 'tempGalleryImgId';
		$imgInfo['fID'] = 'tempFID';
		$imgInfo['fileName'] = 'tempFilename';
		$imgInfo['origfileName'] = 'tempOrigFilename';
		$imgInfo['thumbPath'] = 'tempThumbPath';
		$imgInfo['imgHeight'] = 'tempHeight';
		$imgInfo['imgWidth'] = 'tempWidth';
		$imgInfo['class'] = 'caroufredselImageSlider-imgRow';
		?>
		<?php $this->inc('image_row_include.php', array('imgInfo' => $imgInfo)); ?>
	</div>
</div>
</div>