var xmlPath = "E://IDE_PHP_Workspace//Book_Store//data//"

function killAllTheCurrentRequest(){
  if(typeof ajax_request !== 'undefined')
        ajax_request.abort();
  if(xhr && xhr.readyState != 4){
      xhr.abort();
  }
}
	
/*
 * Function to create the Request for XHR Request.
 */
function createRequest() 
{
	var xhr = false;	
	if (window.XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else if (window.ActiveXObject)
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	return xhr;
}
/*
 * Function to create the Asyn Connection and handler for XHR Request.
 */
function createAsyncConection(xhrObj, url, method, requestparams, elementToAppendOnCallBack)
{
	requestparams = requestparams + "&xmlPath=" + xmlPath;
	if (method == "get")
		url =  url +"?"+requestparams
	
	xhrObj.open(method, url, true);
	
	if (method == "post")
		xhrObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	else
		url = url+ "&xmlPath=" + xmlPath
	
	xhr.onreadystatechange = function() 
	{
		if (xhr.readyState == 4 && xhr.status == 200) {
			elementToAppendOnCallBack.innerHTML = xhr.responseText;
		}
	}
	xhrObj.send(requestparams); 
}

function createAsyncConectionWithCallBack(xhrObj, url, method, requestparams, callBackFunction)
{
	requestparams = requestparams + "&xmlPath=" + xmlPath;
	if (method == "get")
		url =  url +"?"+requestparams
	
	xhrObj.open(method, url, true);
	
	if (method == "post")
		xhrObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	else
		url = url+ "&xmlPath=" + xmlPath
	
	xhr.onreadystatechange = callBackFunction;
	xhrObj.send(requestparams); 
}
