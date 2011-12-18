<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));
class CaroufredselImageSliderBlockController extends BlockController {
	
	var $pobj;
	
	protected $btTable = 'btCaroufredselImageSlider';
	protected $btInterfaceWidth = "580";
	protected $btInterfaceHeight = "420";

	/** 
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Display a carousel of images and their attributes.");
	}
	
	public function getBlockTypeName() {
		return t("Caroufredsel Image Slider");
	}
	
	public function getJavaScriptStrings() {
		return array(
			'choose-file' => t('Choose Image/File'),
			'choose-min-2' => t('Please choose at least two images.'),
			'choose-fileset' => t('Please choose a file set.')
		);
	}
	
	function __construct($obj = null) {		
		parent::__construct($obj);
		$this->db = Loader::db();
		if ($this->fsID == 0) {
			$this->loadImages();
		} else {
			$this->loadFileSet();
		}
		$this->set('fsID', $this->fsID);
		$this->set('fsName', $this->getFileSetName());
		$this->set('images', $this->images);
		$type = ($this->fsID > 0) ? 'FILESET' : 'CUSTOM';
		$this->set('type', $type);
		$this->set('bID', $this->bID);
	}	
	
	function view(){
	}
	
	public function on_page_view() {
		$html = Loader::helper('html');
		$this->addHeaderItem($html->javascript('jquery.carouFredSel-5.4.0-packed.js', 'caroufredsel_image_slider'));
		$this->addHeaderItem($html->javascript('jquery.easing.1.3.js', 'caroufredsel_image_slider'));
          $this->addHeaderItem($html->css('slider_styles.css', 'caroufredsel_image_slider'));
	}
	
	function getFileSetName(){
		$sql = "SELECT fsName FROM FileSets WHERE fsID=".intval($this->fsID);
		return $this->db->getOne($sql); 
	}

	function loadFileSet(){
		if (intval($this->fsID) < 1) {
			return false;
		}
          Loader::helper('concrete/file');
		Loader::model('file_attributes');
		Loader::library('file/types');
		Loader::model('file_list');
		Loader::model('file_set');
		
		$ak = FileAttributeKey::getByHandle('height');
		
		$fs = FileSet::getByID($this->fsID);
		$fileList = new FileList();		
		$fileList->filterBySet($fs);
		$fileList->filterByType(FileType::T_IMAGE);
		$files = $fileList->get(1000,0);				

		$image = array();
		$image['description'] = '';
		$images = array();
		$maxHeight = 0;
		foreach ($files as $f) {
			$fp = new Permissions($f);
			if(!$fp->canRead()) { continue; }
							
			$image['fID'] 			= $f->getFileID();
			$image['fileName'] 		= $f->getFileName();
			$image['fullFilePath'] 	= $f->getPath();
			$image['url']			= $f->getRelativePath();
		
			// find the max height of all the images so galleria doesn't bounce around while rotating
			$vo = $f->getAttributeValueObject($ak);
			if (is_object($vo)) {
				$image['imgWidth'] = $vo->getValue('width');
				$image['imgHeight'] = $vo->getValue('height');
			}
			if ($maxHeight == 0 || $file['value'] > $maxHeight) {
				$maxHeight = $file['value'];
			}
			$images[] = $image;
		}
		$this->images = $images;
	}

	function loadImages(){
		if(intval($this->bID)==0) $this->images=array();
		if(intval($this->bID)==0) return array();
		$sql = "SELECT * FROM btCaroufredselImageSliderImg WHERE bID=?";
		$this->images=$this->db->getAll($sql,array(intval($this->bID))); 
	}
	
	function delete(){
		$this->db->query("DELETE FROM btCaroufredselImageSliderImg WHERE bID=?", array(intval($this->bID)));
		parent::delete();
	}
	
	function save($data) { 
		if( $data['type'] == 'FILESET' && $data['fsID'] > 0){
			$args['fsID'] = $data['fsID'];

			$files = $this->db->getAll("SELECT fv.fID FROM FileSetFiles fsf, FileVersions fv WHERE fsf.fsID = ? AND fsf.fID = fv.fID AND fvIsApproved = 1", array($data['fsID']));
			
			//delete existing images
			$this->db->query("DELETE FROM btCaroufredselImageSliderImg WHERE bID=?", array(intval($this->bID)));
		} else if( $data['type'] == 'CUSTOM' && count($data['imgFIDs']) ){
			$args['fsID'] = 0;

			//delete existing images
			$this->db->query("DELETE FROM btCaroufredselImageSliderImg WHERE bID=?", array(intval($this->bID)));
			
			//loop through and add the images
			$pos=0;
			foreach($data['imgFIDs'] as $imgFID){ 
				if(intval($imgFID)==0 || $data['fileNames'][$pos]=='tempFilename') continue;
				$vals = array(
                         intval($this->bID),
                         intval($imgFID),
                         $pos
					);
				$this->db->query("INSERT INTO btCaroufredselImageSliderImg (bID,fID,position) values (?,?,?)",$vals);
				$pos++;
			}
		}
		
		parent::save($args);
	}
	
	function duplicate($newBID){
		$db = Loader::db();
		if ($this->fsID > 0){
			$sql = "UPDATE btCaroufredselImageSliderImage set bID = ? WHERE bID = ?";
			$val = array($newBID, $this->bID);
		}
		return parent::dupblicate($newBID);
	}
	
}

?>
