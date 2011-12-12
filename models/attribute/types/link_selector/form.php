<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php  
$form = Loader::helper('form'); 
$pageSelector = Loader::helper('form/page_selector');
?>
<style>
	<?php if ($includeLink){?>
	#link-elements<?php echo $key->getAttributeKeyID()?>{
		display: block;
	}
	<?php } else { ?>
	#link-elements<?php echo $key->getAttributeKeyID()?>{
		display: none;
	}	
	<?php } ?>
	<?php if ($linkType == "manual"){?>
	#link-url-wrap<?php echo $key->getAttributeKeyID()?>{ display: block;}
	#link-cid-wrap<?php echo $key->getAttributeKeyID()?>{ display: none;}
	<?php } else { ?>
	#link-url-wrap<?php echo $key->getAttributeKeyID()?>{ display: block;}
	#link-cid-wrap<?php echo $key->getAttributeKeyID()?>{ display: none;}
	<?php } ?>
</style>
<div class="ccm-link-selector-wrap">
     <input type="checkbox" id="<?php echo($this->field('includeLink'));?>" name="<?php echo($this->field('includeLink'));?>" value="1" onclick="linkselector.toggleLinkElements()"<?php if ($includeLink) {echo " checked='checked '";}?>/><?php    echo t('Link to a page?')?>
     <div id="link-elements<?php echo $key->getAttributeKeyID()?>">
		<div class="ccm-input-wrap">
			<label for="linkText"><?php    echo t("Link Text (if applicable)"); ?></label>
			<?php   echo  $form->text($this->field('linkText'), $linkText); ?>
		</div>
		<div class="ccm-input-wrap">
			<input type="radio" id="link-type-manual<?php echo $key->getAttributeKeyID()?>" name="<?php echo($this->field('linkType'));?>" value="manual" onclick="linkselector.toggleUrlType('manual')"<?php    if ($linkType == "manual") { echo " checked ";} ?>><?php    echo(t('Manually Enter URL')) ?>
			<input type="radio" id="link-type-sitemap<?php echo $key->getAttributeKeyID()?>" name="<?php echo($this->field('linkType'));?>" value="sitemap" onclick="linkselector.toggleUrlType('sitemap')"<?php    if ($linkType == "sitemap") {echo " checked ";} ?>><?php    echo(t('Choose From Site Map')) ?>
		</div>
		<div class="ccm-input-wrap">
			<div id="link-url-wrap<?php echo $key->getAttributeKeyID()?>" class="ccm-input-wrap">
			<?php echo $form->text($this->field('linkURL'), $linkURL); ?>
			<span class="small"><?php echo(t('Should be a full url including protocol (usually http://)')) ?></span>
			</div>
			<div id="link-cid-wrap<?php echo $key->getAttributeKeyID()?>" class="ccm-input-wrap">
			<?php echo $pageSelector->selectPage($this->field('linkCID'), $linkCID, 'ccm_selectSitemapNode'); ?>
			</div>
		</div>
     </div>
</div>
<script type="text/javascript">
var linkselector = {
	toggleLinkElements: function(){
		$('#link-elements<?php echo $key->getAttributeKeyID()?>').toggle();
	},
	toggleUrlType: function(type){
		if (type == "manual"){
			$('#link-url-wrap<?php echo $key->getAttributeKeyID()?>').css('display', 'block');
			$('#link-cid-wrap<?php echo $key->getAttributeKeyID()?>').css('display', 'none');
		} else  if (type == "sitemap"){
			$('#link-url-wrap<?php echo $key->getAttributeKeyID()?>').css('display', 'none');
			$('#link-cid-wrap<?php echo $key->getAttributeKeyID()?>').css('display', 'block');
		} 
	}
}
</script>