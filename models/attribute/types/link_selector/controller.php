<?php 
defined('C5_EXECUTE') or die("Access Denied.");

class LinkSelectorAttributeTypeController extends AttributeTypeController  {

	protected $searchIndexFieldDefinition = array(
		'includeLink' => "L 0",
		'linkType' => "C 255 null",
		'linkText' => "C 255 null",
		'linkURL' => "X2 null",
		'linkCID' => "I 0"
	);

	public function getSearchIndexValue() {
		$v = $this->getValue();
		$args = array();
		$args['includeLink'] = $v->getIncludeLink();
		$args['linkType'] = $v->getLinkType();
		$args['linkText'] = $v->getLinkText();
		$args['linkURL'] = $v->getLinkURL();
		$args['linkCID'] = $v->getLinkCID();
		return $args;
	}
	
	public function getValue() {
		$val = LinkSelectorAttributeTypeValue::getByID($this->getAttributeValueID());
		return $val;	
	}
	
	public function searchForm($list) {
		$PagecID = $this->request('value');
		$list->filterByAttribute($this->attributeKey->getAttributeKeyHandle(), $PagecID, '=');
		return $list;
	}
	
	public function search() {
		$form_selector = Loader::helper('form/page_selector');
		print $form_selector->selectPage($this->field('value'), $this->request('value'), false);
	}
	
	public function form() {
		if (is_object($this->attributeValue)) {
			$value = $this->getAttributeValue()->getValue();
			$this->set('includeLink', $value->getIncludeLink());
			$this->set('linkType', $value->getLinkType());
			$this->set('linkURL', $value->getLinkURL());
			$this->set('linkCID', $value->getLinkCID());
		}
		$this->set('key', $this->attributeKey);
	}
	
	public function validateForm($p) {
		return $p['value'] != 0;
	}

	public function saveValue($data) {
		$db = Loader::db();
		if ($data instanceof LinkSelectorAttributeTypeValue) {
			$data = (array) $data;
		}
		extract($data);
		$db->Replace('atLinkSelector', array('avID' => $this->getAttributeValueID(),
			'includeLink' => $includeLink,
			'linkType' => $linkType,
			'linkText' => $linkText,
			'linkURL' => $linkURL,
			'linkCID' => $linkCID
			),
			'avID', true);
	}
	
	public function deleteKey() {
		$db = Loader::db();
		$arr = $this->attributeKey->getAttributeValueIDList();
		foreach($arr as $id) {
			$db->Execute('delete from atLinkSelector where avID = ?', array($id));
		}
	}
	
	public function saveForm($data) {
		$this->saveValue($data);
	}
	
	public function deleteValue() {
		$db = Loader::db();
		$db->Execute('delete from atLinkSelector where avID = ?', array($this->getAttributeValueID()));
	}
	
}

class LinkSelectorAttributeTypeValue extends Object {
	
	public static function getByID($avID){
		$db = Loader::db();
		$value = $db->getRow("select avID, includeLink, linkType, linkText, linkURL, linkCID from atLinkSelector where avID = ?", array($avID));
		$ls = new LinkSelectorAttributeTypeValue();
		$ls->setPropertiesFromArray($value);
		if ($value['avID']) {
			return $ls;
		}
	}
	public function __toString() {
		return "<a href='" . $this->getURL() . "'>" . $this->getLinkText() . "</a>";
	}
	
	public function getIncludeLink(){
		return intval($this->includeLink);
	}
	public function getLinkType(){
		if ($this->getIncludeLink()){
			return $this->linkType;
		}
	}
	public function getLinkText(){
		if ($this->getIncludeLink()){
			return $this->linkText;
		}
	}
	public function getLinkURL(){
		if ($this->getIncludeLink()){
			return $this->linkURL;
		}
	}
	public function getLinkCID(){
		if ($this->getIncludeLink()){
			return $this->linkCID;
		}
	}
	public function getUrl(){
		if ($this->getIncludeLink()){
			if ($this->getLinkType() == "manual"){
				return $this->linkURL;
			} else {
				$nh = Loader::helper('navigation');
				$cID = $this->linkCID;
				$_c = Page::getByID($cID);
				$url = $nh->getLinkToCollection($_c);
				return $url;
			}
		}
	}
}