<?php

defined('C5_EXECUTE') or die("Access Denied.");
$valt = Loader::helper('validation/token');
if(!$valt->validate('update_attributes', $token)){
	$retval['status'] = 'ERROR';
	$retval['error'] = "Invalid form token.";
} else {
	if (intval($_POST['fID'])>0 && intval($_POST['uID'])>0){
		Loader::model("file_attributes");
		$f = File::getByID($_POST['fID']);
		$u = User::getByUserID($_POST['uID']);
		$fp = new Permissions($f);
	if (!$fp->canRead()) {
		$retval['status'] = 'ERROR';
		$retval['error'] = "Invalid permissions on file.";
	} else {
		$setAttribs = null;
		$set = AttributeSet::getByHandle('caroufredsel_slider_attributes');
		if ($set) {
			$setAttribs = $set->getAttributeKeys();
		}
		if ($setAttribs) {
			foreach ($setAttribs as $ak) {
				$ak->saveAttributeForm($f);
			}
			$retval['status'] = "OK";
		}
	}
	} else {
		$retval['status'] = 'ERROR';
		$retval['error'] = "Invalid fID or uID supplied, cannot save attributes.";
	}
}
echo json_encode($retval);
exit;