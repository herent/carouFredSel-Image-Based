<?php

defined('C5_EXECUTE') or die("Access Denied.");
if (intval ($_GET['uID']) > 0 && intval ($_GET['fID']) > 0){
$u = User::getByUserID($_GET['uID']);
$form = Loader::helper('form');
$tool_helper = Loader::helper('concrete/urls');
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
               $("#cancel").click(function(){
                    jQuery.fn.dialog.closeTop();
               });

               // if save is clicked submit the form
               $("#save").click(function(){
                    sendform();
                    return false;
               });

               // if the form is submitted somehow - send it
               $("#recform").submit(function(){
                    sendform();
                    return false;
               });

               $(".hasDatepicker").datepicker();
          });
		
		// submit the form via ajax submit call
		function sendform(){
			tinyMCE.triggerSave();
			$("#recform").ajaxSubmit({
				dataType:'json',
				type:'post',
				success: updateScreen
			});
		}

		function updateScreen(dat){
			
			if (dat.status == "OK"){
				jQuery.fn.dialog.closeTop();
				$("#flex1").flexReload();
			} else {
				alert("<?php     echo t("Database Update Failed");?>");
			}
		}
	</script>
<form id="attributes-form" action="<?php echo $tool_helper->getToolsURL('save_attributes', 'caroufredsel_image_slider');?>">
	<?php foreach ($setAttribs as $ak) {
		echo '<div class="slider-attributes">';
		if (is_object($fv)) {
			$aValue = $fv->getAttributeValueObject($ak);
		}
		echo '<label>' . $ak->render('label') . '</label>';
		echo $ak->render('form', $aValue);
		echo '</div>';
	}?>
</form>
	<div class="ccm-ui">
		<a class="btn" id="cancel"><?php echo t("Cancel");?></a>
		<a class="btn" id="submit"><?php echo t("Submit");?></a>
	</div>
<?php }
} else {
	die (t("Invalid uID or fID"));
}
?>
