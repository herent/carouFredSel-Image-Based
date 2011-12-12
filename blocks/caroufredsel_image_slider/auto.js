var caroufredselImageSlider = {
	
	init:function(){
          if ($("#newImg select[name=type]").val() == 'FILESET') {
               $("#newImg select[name=type]").val('FILESET');
               caroufredselImageSlider.showFileSet();
          } else {
               $("#newImg select[name=type]").val('CUSTOM');
               caroufredselImageSlider.showImages();
          }

          $("#newImg select[name=type]").change(function(){
               if (this.value == 'FILESET') {
                    caroufredselImageSlider.showFileSet();
               } else {
                    caroufredselImageSlider.showImages();
               }
          });

     },
	chooseImg:function(){ 
		ccm_launchFileManager('&fType=' + ccmi18n_filemanager.FTYPE_IMAGE);
	},
	
	showImages:function(){
		$("#caroufredselImageSlider-imgRows").show();
		$("#caroufredselImageSlider-chooseImg").show();
		$("#caroufredselImageSlider-fsRow").hide();
	},

	showFileSet:function(){
		$("#caroufredselImageSlider-imgRows").hide();
		$("#caroufredselImageSliderk-chooseImg").hide();
		$("#caroufredselImageSlider-fsRow").show();
	},

	selectObj:function(obj){
		if (obj.fsID != undefined) {
			$("#caroufredselImageSlider-fsRow input[name=fsID]").attr("value", obj.fsID);
			$("#caroufredselImageSlider-fsRow input[name=fsName]").attr("value", obj.fsName);
			$("#caroufredselImageSlider-fsRow .caroufredselImageSlider-fsName").text(obj.fsName);
		} else {
			this.addNewImage(obj.fID, obj.thumbnailLevel1, obj.height, obj.title);
		}
	},

	addImages:0, 
	addNewImage: function(fID, thumbPath, imgHeight, title) { 
		this.addImages--; //negative counter - so it doesn't compete with real GalleryImgIds
		var GalleryImgId=this.addImages;
		var templateHTML=$('#imgRowTemplateWrap .caroufredselImageSlider-imgRow').html().replace(/tempFID/g,fID);
		templateHTML=templateHTML.replace(/tempThumbPath/g,thumbPath);
		templateHTML=templateHTML.replace(/tempFilename/g,title);
		templateHTML=templateHTML.replace(/tempGalleryImgId/g,GalleryImgId).replace(/tempHeight/g,imgHeight);
		var imgRow = document.createElement("div");
		imgRow.innerHTML=templateHTML;
		imgRow.id='caroufredselImageSlider-imgRow'+parseInt(GalleryImgId);
		imgRow.className='caroufredselImageSlider-imgRow';
		document.getElementById('caroufredselImageSlider-imgRows').appendChild(imgRow);
		var bgRow=$('#caroufredselImageSlider-imgRow'+parseInt(fID)+' .backgroundRow');
		bgRow.css('background','url('+thumbPath+') no-repeat left top');
	},
	
	removeImage: function(fID){
		$('#caroufredselImageSlider-imgRow'+fID).remove();
	},
	
	moveUp:function(fID){
		var thisImg=$('#caroufredselImageSlider-imgRow'+fID);
		var qIDs=this.serialize();
		var previousQID=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				if(previousQID==0) break; 
				thisImg.after($('#caroufredselImageSlider-imgRow'+previousQID));
				break;
			}
			previousQID=qIDs[i];
		}	 
	},
	moveDown:function(fID){
		var thisImg=$('#caroufredselImageSlider-imgRow'+fID);
		var qIDs=this.serialize();
		var thisQIDfound=0;
		for(var i=0;i<qIDs.length;i++){
			if(qIDs[i]==fID){
				thisQIDfound=1;
				continue;
			}
			if(thisQIDfound){
				$('#caroufredselImageSlider-imgRow'+qIDs[i]).after(thisImg);
				break;
			}
		} 
	},
	serialize:function(){
		var t = document.getElementById("caroufredselImageSlider-imgRows");
		var qIDs=[];
		for(var i=0;i<t.childNodes.length;i++){ 
			if( t.childNodes[i].className && t.childNodes[i].className.indexOf('caroufredselImageSlider-imgRow')>=0 ){
				var qID=t.childNodes[i].id.replace('caroufredselImageSlider-imgRow','');
				qIDs.push(qID);
			}
		}
		return qIDs;
	},	

	validate:function(){
		var failed=0; 
		
		if ($("#newImg select[name=type]").val() == 'FILESET')
		{
			if ($("#caroufredselImageSlider-fsRow input[name=fsID]").val() <= 0) {
				alert(ccm_t('choose-fileset'));
				$('#textAndImageGalleryBlock-AddImg').focus();
				failed=1;
			}	
		} else {
			qIDs=this.serialize();
			if( qIDs.length<2 ){
				alert(ccm_t('choose-min-2'));
				$('#caroufredselImageSlider-AddImg').focus();
				failed=1;
			}	
		}
		
		if(failed){
			ccm_isBlockError=1;
			return false;
		}
		return true;
	}
}

ccmValidateBlockForm = function() { return caroufredselImageSlider.validate(); }
ccm_chooseAsset = function(obj) { caroufredselImageSlider.selectObj(obj); }

$(function() {
	caroufredselImageSlider.init();
});

