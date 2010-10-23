/**
* Google calendar upcoming events module
* @author allon
* @version $Revision: 1.5.0 $
**/


var RSSRequestObject = false; // XMLHttpRequest Object
var is24Hour = true; //24 or 12 hour time

if (window.XMLHttpRequest) { // FF, Safari, Opera
	RSSRequestObject = new XMLHttpRequest();
	if (RSSRequestObject.overrideMimeType) {
    	RSSRequestObject.overrideMimeType('text/xml');
    } 
}
else if (window.ActiveXObject){ // IE
    try {
        RSSRequestObject = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            RSSRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {}
    }
}

RSSRequest();

/*
* Main AJAX RSS reader request
*/
function RSSRequest() {
	document.getElementById("upcoming_events_content").innerHTML = checkingtext;
	
	// Prepare the request
	RSSRequestObject.open("GET", Backend );
	
	// Set the onreadystatechange function
	RSSRequestObject.onreadystatechange = ReqChange;
	
	// Send
	RSSRequestObject.send(null); 
}

/*
* onreadystatechange function
*/
function ReqChange() {

	// If data received correctly
	if (RSSRequestObject.readyState == 4) {
		var xmlDoc;
			//Just to check if it is a different navigator from internet explorer
		if (document.implementation && document.implementation.createDocument){
			xmlDoc = RSSRequestObject.responseXML;
		//In case to be the internet explorer
		} else if (window.ActiveXObject){
			//Create a xml tag in run time
			var testandoAppend = document.createElement('xml');
			//Put the requester.responseText in the innerHTML of the xml tag
			testandoAppend.setAttribute('innerHTML',RSSRequestObject.responseText);
			//Set the xml tag's id to _formjAjaxRetornoXML
			testandoAppend.setAttribute('id','_formjAjaxRetornoXML');
			//Add the created tag to the page context
			document.body.appendChild(testandoAppend);
			//Just for check put the xmlhttp.responseXML in the innerHTML of the tag
			document.getElementById('_formjAjaxRetornoXML').innerHTML = RSSRequestObject.responseText;
			//Now we can get the xml tag and put it on a var
			xmlDoc = document.getElementById('_formjAjaxRetornoXML');
			//So we have a valid xml we can remove the xml tag 
			document.body.removeChild(document.getElementById('_formjAjaxRetornoXML'));
		}
		var node = xmlDoc.documentElement; 
		
		// if data is valid
		if (node.getElementsByTagName('error').length==0) { 	
			// Parsing Feeds
            var content = '';
            
			// Get the calendar title - uncomment next two lines if you want it to show up
			//var title = node.getElementsByTagName('title').item(0).firstChild.data;
			//var content = '<div class="channeltitle">' + title + '</div>';
            var timezone='';
            try { 
            	timezone = node.getElementsByTagName('timezone').item(0).getAttribute("value");  
            } catch (e) {	
				try {
					timezone = node.getElementsByTagNameNS('*', 'timezone').item(0).getAttribute("value"); 
				} catch (e) {
					var timezone = '';
				}
			}
            
			// Browse events
			var items = node.getElementsByTagName('entry');
            var itemTimePrev = new Date();
            itemTimePrev.setTime(0000);
            if (items.length == 0) {
				content += '<div align="center">'+noEventsText+'</div>';
			} else {
				for (var n=0; n < items.length; n++) {
					var itemTitle=busyText;
					
					if(items[n].getElementsByTagName('title').length>0) {
						itemTitle = items[n].getElementsByTagName('title').item(0).firstChild.data;
                    } else {
						if(items[n].getElementsByTagNameNS('*', 'title').length>0) {
							itemTitle = items[n].getElementsByTagNameNS('*', 'title').item(0).firstChild.data;
						} 
                    }
					
                    //Here's a little love for our friend IE - he hates standards, like XML namespace.
                    try { 
						var itemTimeXML = items[n].getElementsByTagName('when')[0].getAttribute("startTime");  
                    } catch (e) { 
						try {
							var itemTimeXML = items[n].getElementsByTagName('gd:when')[0].getAttribute("startTime");
						} catch (e) {
							try {
								var itemTimeXML = items[n].getElementsByTagNameNS('*', 'when')[0].getAttribute("startTime");
							} catch (e) {
								var itemTimeXML = '';
							}
						}
                    }
                    
                    var isAllDay = false; //init isAllDay variable
                    var dateFound = true;
                    
                    if (itemTimeXML.length <= 10) isAllDay = true; //just the date is only 10 digits = all day event
                    
                    var itemTime = new Date();
                    
                    if (itemTimeXML.length != 0) {
                    	if(!isAllDay){
	                    	itemTime=new Date(itemTimeXML.substr(0,4),
	                    		(itemTimeXML.substr(5,2)-1),
	                    		itemTimeXML.substr(8,2),
	                    		itemTimeXML.substr(11,2),
	                    		itemTimeXML.substr(14,2));
	                    } else {
	                    	itemTime=new Date(itemTimeXML.substr(0,4),
	                    		(itemTimeXML.substr(5,2)-1),
	                    		itemTimeXML.substr(8,2));
	                    }
					} else dateFound = false; 
					
					try {
						var itemLink =  items[n].getElementsByTagName('link')[0].getAttribute("href");
					} catch (e) {
						var itemLink = "";
					}
                    
                    var itemContent = ' - ';
					try { 
                        itemContent += items[n].getElementsByTagName('content').item(0).firstChild.data;  
                    } catch (e) {	
						try {
							itemContent += items[n].getElementsByTagNameNS('*', 'content').item(0).firstChild.data; 
						} catch (e) {
							var itemContent = '';
						}
					}
                    
                    content+='<div>';
                    try {
	                    if(!isAllDay) content+= dateFormat(itemTime, df);
	                    else content+= dateFormat(itemTime, dff);
                    } catch (e) {
						content+=itemTimeXML;
					}
                    
                    content+='</div>';
                    var link = 'href="'+backLink.replace('{eventPlace}',itemLink.substring(itemLink.indexOf('eid=')+4,itemLink.length)).replace('{ctzPlace}',timezone)+'"';
                    if(openInNewWindow==1)
                      link='href="'+itemLink+'" target="_blank"';
                    content += '<a '+link+'>'+itemTitle+'</a>';
                    content+='<br><hr width="100%">';
                    itemTimePrev.setTime(itemTime); //Save the last timestamp for next iteration comparison
				}
			}
			
			// Display the result
			document.getElementById("upcoming_events_content").innerHTML = content;
		} else {
			// Tell the reader that there was error requesting data
			var x=node.getElementsByTagName('error');
			for (i=0;i<x.length;i++) {
			  document.getElementById("upcoming_events_content").innerHTML = "<div class=error>"+x[i].childNodes[0].nodeValue+"<div>";
			}
		}
	}
	
}
