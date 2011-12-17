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
		Loader::model('attribute/categories/file');
		// install block		
		BlockType::installBlockTypeFromPackage('caroufredsel_image_slider', $pkg);
		BlockType::installBlockTypeFromPackage('basic_test', $pkg);
		
		$eaku = AttributeKeyCategory::getByHandle('file');
		$eaku->setAllowAttributeSets(AttributeKeyCategory::ASET_ALLOW_SINGLE);
		
		$linkselector = AttributeType::add('link_selector', t('Link Selector'), $pkgh);
		$linkselectorid = $linkselector->getAttributeTypeID();
		$eakuid = $db->GetOne('select akCategoryID from AttributeKeyCategories where akCategoryHandle = ?', array("file"));
		$sql = "SELECT * FROM AttributeTypeCategories WHERE atID = ? AND akCategoryID = ?";
		$val = array($linkselectorid, $eakuid);
		$row = $db->GetRow($sql, $val);
		if (!(intval($row['atID']) > 0)){
			$eaku->associateAttributeKeyType($linkselector);
		}
		
		$evset = $eaku->addSet('caroufredsel_slider_attributes', t('Slider Attributes'),$pkg);
		
		$textarea = AttributeType::getByHandle('textarea');
		$text = AttributeType::getByHandle('text');
		
		$image_slider_title = FileAttributeKey::getByHandle('caroufredsel_imager_slide_title');
		if (!$image_slider_title instanceof FileAttributeKey){
			$image_slider_title = FileAttributeKey::add($text, array('akHandle' => 'caroufredsel_image_slider_title', 'akName' => t('Slide Title'), 'akIsSearchable' => true), $pkg);
			$image_slider_title->setAttributeSet($evset);
			
		}
		
		$image_slider_text = FileAttributeKey::getByHandle('caroufredsel_image_slider_text');
		if (!$image_slider_text instanceof FileAttributeKey){
			$image_slider_text = FileAttributeKey::add($textarea, array('akHandle' => 'caroufredsel_image_slider_text', 'akName' => t('Slide Text'), 'akIsSearchable' => true, 'akTextareaDisplayMode'=>'rich_text'), $pkg);
			$image_slider_text->setAttributeSet($evset);
			
		}
		
		$image_slider_link = FileAttributeKey::getByHandle('caroufredsel_image_slider_link');
		if (!$image_slider_link instanceof FileAttributeKey){
			$image_slider_link = FileAttributeKey::add($linkselector, array('akHandle'=>'caroufredsel_image_slider_link', 'akName' => t('Slide Link'), 'akIsSearchable' => false), $pkg);
			$image_slider_link->setAttributeSet($evset);
			
		}
		
	}

}