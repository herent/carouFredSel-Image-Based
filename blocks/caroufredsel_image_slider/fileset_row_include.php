<?php    defined('C5_EXECUTE') or die(_("Access Denied.")); ?> 
<div id="textAndImageGalleryBlock-fsRow" class="textAndImageGalleryBlock-fsRow" >
	<div class="backgroundRow" style="padding-left: 100px">
		<strong>File Set:</strong> <?php   echo $form->select('fsID', $fsInfo['fileSets'], $fsInfo['fsID'])?>
	</div>
</div>
