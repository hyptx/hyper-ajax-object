var hypCurrentTarget,hypCurrentUrl,hypCurrentTimerTarget,hypResponseText,hypResponseJSON,hypResponseXML;
var hypAutoClear = true;
var hypEvent = new Event();
var hypAjaxLoader = new Object();
function hypAjaxLoad(target,url,type){
	targetDiv = document.getElementById(target);
	if(type == 'onload') var isOnload = true;
	if(type == 'refresh') var isRefresh = true;
	if(targetDiv){
		if(targetDiv.innerHTML != '' && !isRefresh){
			if(hypCurrentUrl != url && hypCurrentTarget == target) {/* Cont */;}
			else if(hypAutoClear){
				targetDiv.innerHTML = '';
				hypCurrentUrl = '';
				return;
			}
		}
	}
	//Set Current
	if(isOnload){
		 hypCurrentUrl = '';
		 hypCurrentTarget = '';
		 //hypCurrentUrl = url; //For Pagination
		 //hypCurrentTarget = target; //For Pagination
	}
	else if(!isRefresh){
		 hypCurrentUrl = url;
		 hypCurrentTarget = target;
	}	
	//XMLHttp
	if(window.XMLHttpRequest) var xmlhttp = new XMLHttpRequest();
	else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			hypResponseText = xmlhttp.responseText;
			//XML Routine
			if(xmlhttp.getResponseHeader('Content-Type') == 'text/xml'){ hypResponseXML = xmlhttp.responseXML; }
			else{ //JSON Check
				try{ hypResponseJSON = JSON.parse(hypResponseText); }
				catch(e){ hypResponseJSON = 'Error: Data is not JSON format'; }
			}
			//Print Response
			targetDiv = document.getElementById(target);
			if(targetDiv) targetDiv.innerHTML = hypResponseText;
			
			//Dispatch Event
			var ajaxObject = new Object();
			ajaxObject.target = target;
			ajaxObject.url = url;
			ajaxObject.type = type;
			ajaxObject.text = hypResponseText;
			ajaxObject.json = hypResponseJSON;
			ajaxObject.xml = hypResponseXML;
			hypEvent.fireEvent(ajaxObject,hypAjaxLoader,'ajax_loaded');
		}
	}
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

/* ~~~~~~~~~ Main ~~~~~~~~~ */

//Enable Auto Clear
function hypEnableAutoClear(){ hypAutoClear = true; }
//Disable Auto Clear
function hypDisableAutoClear(){	hypAutoClear = false; }

//Clear Div
function hypClearDiv(clearTarget){
	var targetDiv = document.getElementById(clearTarget);
	if(targetDiv) {targetDiv.innerHTML = ''};
	hypCurrentTarget = targetDiv;
}
//Timed Clear
function hypTimedClear(timerTarget,clearTime){
	hypCurrentTimerTarget = timerTarget;
	hypEvent.addListener(hypAjaxLoader,'ajax_loaded',hypStartTimer);
	function hypStartTimer(evt){ 
		if(evt.target != timerTarget) return
		setTimeout("hypClearDiv(hypCurrentTimerTarget)",clearTime); 
	}
}

/* ~~~~~~~~~ Testing ~~~~~~~~~ */

function print_r(theObj){
	if(theObj.constructor == Array || theObj.constructor == Object){
    	document.write("<ul>")
        for(var p in theObj){
        	if(theObj[p].constructor == Array || theObj[p].constructor == Object){
            	document.write("<li>["+p+"] => "+typeof(theObj)+"</li>");
                document.write("<ul>")
                print_r(theObj[p]);
                document.write("</ul>")
            }else document.write("<li>["+p+"] => "+theObj[p]+"</li>");
        }
		document.write("</ul>")
	}
}
/* Reference
alert(target +' | cur-'+ hypCurrentTarget +'\n'+ url +' | cur-'+ hypCurrentUrl);
hypEvent.addListener(hypAjaxLoader,'ajax_loaded',hypEventHandler);
function hypEventHandler(evt){ alert(evt); }
hypEvent.fireEvent(hypCurrentTarget,hypAjaxLoader,'ajax_loaded'); //Dispatcher
*/