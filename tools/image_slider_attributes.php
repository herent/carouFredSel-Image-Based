<?php

defined('C5_EXECUTE') or die("Access Denied.");
if (intval ($_GET['uID']) > 0 && intval ($_GET['fID']) > 0){
$u = User::getByUserID($_GET['uID']);
$form = Loader::helper('form');
$tool_helper = Loader::helper('concrete/urls');
$valt = Loader::helper('validation/token');
Loader::model("file_attributes");

$f = File::getByID($_GET['fID']);
$fp = new Permissions($f);
if (!$fp->canRead()) {
	die(t("Access Denied."));
}
$fv = $f->getApprovedVersion();
$setAttribs = null;
$set = AttributeSet::getByHandle('caroufredsel_slider_attributes');
if ($set) {
	$setAttribs = $set->getAttributeKeys();
}
if ($setAttribs) {?>
<script>
          
          $(function(){
               // close the dialog if cancel is clicked;

               $("#attributes-form-cancel").click(function(){
                    jQuery.fn.dialog.closeTop();
               });

               // if save is clicked submit the form

               $("#attributes-form-save").click(function(){
                    sendform();
                    return false;
               });

               // if the form is submitted somehow - send it
               $("#attributes-form").submit(function(){
                    sendform();
                    return false;
               });
          });
		
		// submit the form via ajax submit call
		function sendform(){
			tinyMCE.triggerSave();
			$("#attributes-form").ajaxSubmit({
				dataType:'json',
				type:'post',
				success: updateScreen
			});
		}

		function updateScreen(dat){
			
			if (dat.status == "OK"){
				ccm_chooseAsset = function(obj) { caroufredselImageSlider.selectObj(obj); }
				jQuery.fn.dialog.closeTop();
			} else {
				alert(dat.error);
			}
		}
	</script>
<style type="text/css">
	.slider-attributes {
		display: block;
		padding-bottom: 5px;
		margin-bottom: 5px;
		border-bottom: 2px dotted #CCC;
	}
	.sidler-attributes label {
		display: block;
		font-weight: bold;
	}
	.slider-attributes .field {
		display: block;
	}
</style>
<form id="attributes-form" action="<?php echo $tool_helper->getToolsURL('save_image_slider_attributes', 'caroufredsel_image_slider');?>" method="post">
	<?php  $valt->output('update_attributes')?>
	<input type="hidden" name="fID" value="<?php echo $_GET['fID'];?>">
	<input type="hidden" name="uID" value="<?php echo $_GET['uID'];?>">
	<?php foreach ($setAttribs as $ak) {
		echo '<div class="slider-attributes">';
		if (is_object($fv)) {
			$aValue = $fv->getAttributeValueObject($ak);
		}
		echo '<label>' . $ak->render('label') . '</label>';
		echo '<div class="field">';
		echo $ak->render('form', $aValue);
		echo '</div></div>';
	}?>
</form>
	<div class="dialog-buttons">
		<a class="ccm-button-left cancel btn" id="attributes-form-cancel"><?php echo t("Cancel");?></a>
		<a class="ccm-button-right primary btn" id="attributes-form-save"><?php echo t("Save Attributes");?></a>
	</div>
<?php }
} else {
	die (t("Invalid uID or fID"));
}
?>
