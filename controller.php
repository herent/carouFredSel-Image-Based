<?php    

defined('C5_EXECUTE') or die(_("Access Denied."));

class CaroufredselImageSliderPackage extends Package {

	protected $pkgHandle = 'caroufredsel_image_slider';
	protected $appVersionRequired = '5.4.1.1';
	protected $pkgVersion = '1.0';
	
	public function getPackageName() {
		return t("Caroufredsel Image Slider");
	}	
	
	public function getPackageDescription() {
		return t("Add a gallery of images with two titles and a text field.");
	}
	
	public function install() {
		$pkg = parent::install();
		$pkgh = Package::getByHandle('caroufredsel_image_slider'); 
		$db = Loader::db();
		// install block		
		BlockType::installBlockTypeFromPackage('caroufredsel_image_slider', $pkg);
		
		$eaku = AttributeKeyCategory::getByHandle('file');
		$eaku->setAllowAttributeSets(AttributeKeyCategory::ASET_ALLOW_SINGLE);
		
		$linkselector = AttributeType::add('link_selector', t('Link Selector'), $pkgh);
		$linkselectorid = $linkselector->getAttributeTypeID();
		$eakuid = $eaku->ID;
		$sql = "SELECT * FROM AttributeTypeCategories WHERE atID = ? AND akCategoryID = ?";
		$val = array($linkselectorid, $eakuid);
		$res = $db->query($sql, $val);
		if (!$res){
			$eaku->associateAttributeKeyType($linkselector);
		}
		
		$evset = $eaku->addSet('caroufredsel_slider_attributes', t('Slider Attributes'),$pkg);
		
		$textarea = AttributeType::getByHandle('textarea');
		$text = AttributeType::getByHandle('text');
	}

}