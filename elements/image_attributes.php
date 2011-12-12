<?php

defined('C5_EXECUTE') or die("Access Denied.");
$u = new User();
$form = Loader::helper('form');
Loader::model("file_attributes");

$f = File::getByID($fID);

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
if ($setAttribs) {
	foreach ($setAttribs as $ak) {
		echo '<div class="slider-attributes">';
		if (is_object($fv)) {
			$aValue = $fv->getAttributeValueObject($ak);
		}
		echo '<label>' . $ak->render('label') . '</label>';
		echo $ak->render('form', $aValue);
		echo '</div>';
	}
}
?>
