<!--//--><![CDATA[//><!--
startList = function() {

	if (document.all&&document.getElementById) {   
			theul = document.getElementById("menu").childNodes[0];
			theul.setAttribute('id','menu_ul');
			navRoot = document.getElementById("menu_ul");
					for (i=0; i<navRoot.childNodes.length; i++) {
						effect(navRoot);
				}
	}   
}

function effect(elementId) {
node = elementId.childNodes[i];
		if (node.nodeName=="LI") {
				node.onmouseover=function() {
					this.className="over";
				}
				node.onmouseout=function() {
					this.className=this.className.replace("over", "");
				}
		}

}

window.onload=startList;


function correctPNG() // correctly handle PNG transparency in Win IE 5.5 & 6. 
{

if (document.all&&document.getElementById) {   
   var arVersion = navigator.appVersion.split("MSIE")
   var version = parseFloat(arVersion[1])
   if ((version >= 5.5) && (document.body.filters)) 
   {
      for(var i=0; i<document.images.length; i++)
      {
         var img = document.images[i]
         var imgName = img.src.toUpperCase()
         if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
         {
            var imgID = (img.id) ? "id='" + img.id + "' " : ""
            var imgClass = (img.className) ? "class='" + img.className + "' " : ""
            var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
            var imgStyle = "display:inline-block;" + img.style.cssText 
            if (img.align == "left") imgStyle = "float:left;" + imgStyle
            if (img.align == "right") imgStyle = "float:right;" + imgStyle
            if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
            var strNewHTML = "<span " + imgID + imgClass + imgTitle
            + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
            + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
            + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
            img.outerHTML = strNewHTML
            i = i-1
         }
      }
   }    
}
}

if (document.all&&document.getElementById) {   
window.attachEvent("onload", correctPNG);
}